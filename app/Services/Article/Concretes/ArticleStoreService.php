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
        $categoryIds = static::getManyCategoryIds($body['categories']);

        return Article::saveWithCategories($body, $categoryIds);

    }
    public static function getManyCategoryIds(array $ids): Collection
    {
        return Category::existed($ids)->get('id')->pluck('id');
    }

}
