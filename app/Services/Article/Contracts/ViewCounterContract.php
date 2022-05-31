<?php

namespace App\Services\Article\Contracts;


use App\Models\Article;
use Illuminate\Http\Request;

interface ViewCounterContract
{
    public function increase(Article $article, string $ip): void;
}
