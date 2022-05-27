<?php

namespace App\Services\Article\Concretes;

use App\Models\Article;
use App\Services\Article\Contracts\ArticleStoreContract;

class ArticleStoreService implements ArticleStoreContract
{
    public function store(array $array) : Article
    {
        return Article::create($array);
    }

}
