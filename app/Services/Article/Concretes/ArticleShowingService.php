<?php

namespace App\Services\Article\Concretes;

use App\Jobs\ViewArticle;
use App\Models\Article;
use App\Models\RealTimeView;
use App\Services\Article\Contracts\ArticleShowingContract;
use App\Services\Article\Contracts\ViewCounterContract;
use Illuminate\Http\Request;

class ArticleShowingService implements ArticleShowingContract, ViewCounterContract
{
    public function getOne(Article $article, Request $request): Article
    {
        $this->increase($article, $request->ip());

        return $article;
    }

    public function increase($article, $ip) : void
    {
        if( ! $this->isViewedBy($article, $ip) )

            ViewArticle::dispatchAfterResponse($article, $ip);
    }

    public function isViewedBy($article, $ip) : bool
    {
        return (bool) RealTimeView::ip($ip)->article($article->id)->first();

    }
}
