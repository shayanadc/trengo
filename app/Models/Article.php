<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The roles that belong to the user.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The roles that belong to the user.
     */
    public function views(): BelongsToMany
    {
        return $this->belongsToMany(View::class, 'views');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeTitle($query, $title): Builder
    {
        return $query->where('title', 'like', $title . '%');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeBody($query, $body): Builder
    {
        return $query->where('body', 'like', $body . '%');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeCreatedAtRange($query, array $dateRange): Builder
    {
        return $query->whereBetween('created_at', $dateRange);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeCategories($query, array $categoryIds): Builder
    {
        return $query->whereHas('categories', function($q) use($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
         });
    }

    /**
     * @param array $categoryIds
     * @return void
     */
    public function setCategories(Collection $categoryIds): void
    {
        $this->categories()->attach($categoryIds);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeView($query): Builder
    {
        return $query->selectRaw('sum(views.count) AS views, articles.*')
            ->leftJoin('views', 'views.article_id', '=', 'articles.id')
            ->groupBy('views.article_id')
            ->orderBy('views', 'desc');
    }

    /**
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeRate($query): Builder
    {
        return $query->orderBy('rate', 'desc');
    }
}
