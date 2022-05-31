<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealTimeView extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'ip'];

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGroupByArticle($query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->groupBy('article_id')
            ->selectRaw('count(*) as count, article_id');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeViewedAt($query, $date): \Illuminate\Database\Eloquent\Builder
    {
        return $query->whereDay('created_at', $date);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArticle($query, $articleId): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('article_id', $articleId);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIp($query, $ip): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('ip', $ip);
    }
}
