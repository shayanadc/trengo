<?php

namespace App\Services\Article\Concretes;

use App\Models\Article;
use App\Query\Article\ArticleBody;
use App\Query\Article\ArticleCategory;
use App\Query\Article\ArticleDate;
use App\Query\Article\ArticleTitle;
use App\Services\Article\Contracts\ArticleListingContract;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;

class ArticleListingService implements ArticleListingContract
{
    public function getMany(): Collection
    {
        $pipeline = app(Pipeline::class)
            ->send(Article::query())
            ->through([
                ArticleTitle::class,
                ArticleBody::class,
                ArticleDate::class,
                ArticleCategory::class
            ])->thenReturn();

        return $pipeline->get();
    }
}
