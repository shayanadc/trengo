<?php

namespace App\Services\Article\Concretes;

use App\Jobs\ViewArticle;
use App\Models\Article;
use App\Services\Article\Contracts\ArticleShowingContract;
use App\Services\Article\Contracts\ViewCounterContract;
use Illuminate\Http\Request;

class ArticleShowingService implements ArticleShowingContract, ViewCounterContract
{
    public function getOne(Article $article, Request $request): Article
    {
        $this->viewedBy($article, $request->ip());

        return $article;
    }

    public function viewedBy($article, $ip) : void
    {
        if( ! $this->isViewedBy($article, $ip) )

            $this->registerView($article, $ip);
    }

    public function registerView($article, $ip)
    {
        ViewArticle::dispatchAfterResponse($article, $ip);
    }

    public function isViewedBy($article, $ip) : bool
    {

        return in_array($article->id, SeenArticleListByIp::getMany($ip));

    }


}
