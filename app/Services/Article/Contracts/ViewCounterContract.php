<?php

namespace App\Services\Article\Contracts;


use App\Models\Article;

interface ViewCounterContract
{
    public function viewedBy(Article $article, string $ip): void;
}
