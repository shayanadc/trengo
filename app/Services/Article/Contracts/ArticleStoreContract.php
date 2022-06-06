<?php

namespace App\Services\Article\Contracts;

use App\Models\Article;

interface ArticleStoreContract
{
    public function store(array $body): Article;

}
