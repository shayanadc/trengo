<?php

namespace App\Services\Review\Concretes;

use App\Models\Article;
use App\Services\Review\Contracts\ArticleRateSyncContract;

class ArticleRateSyncService implements ArticleRateSyncContract
{
    public static function sync($review): void
    {
        Article::where('id', $review['article_id'])
            ->update(['rate' => $review['real_stars']]);
    }
}
