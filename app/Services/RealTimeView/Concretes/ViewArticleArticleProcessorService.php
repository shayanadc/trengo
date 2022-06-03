<?php

namespace App\Services\RealTimeView\Concretes;

use App\Models\Article;
use App\Models\RealTimeView;
use App\Services\RealTimeView\Contracts\ViewArticleProcessorContract;

class ViewArticleArticleProcessorService implements ViewArticleProcessorContract
{
    public function store(Article $article, string $ip) : void
    {
        RealTimeView::create(['article_id' => $article->id, 'ip'=> $ip]);
    }
}
