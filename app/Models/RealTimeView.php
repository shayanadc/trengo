<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealTimeView extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'ip'];

    /**
     * Scope a query to only include popular users.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeGroupByArticle($query): Builder
    {
        return $query->groupBy('article_id')
            ->selectRaw('count(*) as count, article_id');
    }

    /**
     * Scope a query to only include viewed at.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeViewedAt($query, $date): Builder
    {
        return $query->whereDay('created_at', $date);
    }

    /**
     * Scope a query to only with article id.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeArticle($query, $articleId): Builder
    {
        return $query->where('article_id', $articleId);
    }

    /**
     * Scope a query to only included ip.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeIp($query, $ip): Builder
    {
        return $query->where('ip', $ip);
    }
}
