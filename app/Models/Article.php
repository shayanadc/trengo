<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The categories that belong to the article.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The daily views that belong to the article.
     */
    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }


    /**
     * Scope a query to only like title.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeTitle($query, $title): Builder
    {
        return $query->where('title', 'like', $title . '%');
    }

    /**
     * Scope a query to only like body.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeBody($query, $body): Builder
    {
        return $query->where('body', 'like', $body . '%');
    }

    /**
     * Scope a query to only include created in range.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeCreatedAtRange($query, array $dateRange): Builder
    {
        return $query->whereBetween('created_at', $dateRange);
    }

    /**
     * Scope a query to only include categories.
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
     * Scope a query to order by views count.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeView($query): Builder
    {
        return $query->orderBy('views_count', 'desc');
    }

    /**
     * Scope a query to order by rate rank.
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeRate($query): Builder
    {
        return $query->orderBy('rate', 'desc');
    }


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('views', function (Builder $query) {
            $query->withCount(['views' => function($query) {
                $query->select(DB::raw('COALESCE(sum(count), 0)'));
            }]);
        });
    }

    public static function saveWithCategories(array $attributes, Collection $categoryIds){
        return DB::transaction(function () use ($attributes, $categoryIds) {

            $article = Article::create($attributes);
            $article->setCategories($categoryIds);

            return $article;

        });
    }

}
