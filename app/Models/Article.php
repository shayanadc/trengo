<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The roles that belong to the user.
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTitle($query, $title): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('title', 'like', $title . '%');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBody($query, $body): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('body', 'like', $body . '%');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedAtRange($query, array $dateRange): \Illuminate\Database\Eloquent\Builder
    {
        return $query->whereBetween('created_at', $dateRange);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategories($query, array $categoryIds): \Illuminate\Database\Eloquent\Builder
    {
        return $query->whereHas('categories', function($q) use($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
         });
    }
}
