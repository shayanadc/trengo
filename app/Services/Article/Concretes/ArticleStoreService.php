<?php

namespace App\Services\Article\Concretes;

use App\Models\Article;
use App\Models\Category;
use App\Services\Article\Contracts\ArticleStoreContract;
use Illuminate\Support\Collection;

class ArticleStoreService implements ArticleStoreContract
{
    public function store(array $body) : Article
    {
        $categoryIds = $body['categories'] ?? [];
        $categoryIds = static::getManyCategoryIds($categoryIds);

        return static::createArticleAndAttachCategories($body, $categoryIds);

    }
    public static function getManyCategoryIds(array $ids): Collection
    {
        return Category::existed($ids)->get('id')->pluck('id');
    }

    public static function createArticleAndAttachCategories($articleAttributes, $categoryIds){
        $article = Article::create($articleAttributes);
        $article->attachCategories($categoryIds);
        return $article;
    }

}
