<?php

namespace App\Services\Article\Contracts;


use App\Models\Article;
use Illuminate\Http\Request;

interface ArticleShowingContract
{
    public function getOne(Article $article, Request $request) : Article;
}
