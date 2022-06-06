<?php

namespace App\Services\RealTimeView\Contracts;

use App\Models\Article;

interface ViewArticleProcessorContract
{
    public function store(Article $article, string $ip) : void;

}
