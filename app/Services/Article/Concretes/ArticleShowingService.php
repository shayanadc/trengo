<?php

namespace App\Services\Article\Concretes;

use App\Jobs\ViewArticle;
use App\Models\Article;
use App\Models\RealTimeView;
use App\Services\Article\Contracts\ArticleShowingContract;
use App\Services\Article\Contracts\ViewCounterContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

            ViewArticle::dispatchAfterResponse($article, $ip);
    }

    public function isViewedBy($article, $ip) : bool
    {

        return in_array($article->id, $this->getSeenArticleFromCache($ip));

    }

    /**
     * @param $ip
     * @return mixed
     */
    public function getSeenArticleFromCache($ip): mixed
    {
        return Cache::remember('articles_seen_' . $ip, 3600, function () use ($ip) {

            return RealTimeView::ip($ip)->get('article_id')->pluck('article_id')->toArray();

        });
    }
}
