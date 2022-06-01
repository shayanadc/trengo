<?php

namespace App\Services\Review\Concretes;

use App\Jobs\ArticleRateUpdater;
use App\Models\Article;
use App\Models\Review;
use App\Services\Review\Contracts\ArticleRateCollectorContract;

class ArticleReviewCollectorService implements ArticleRateCollectorContract
{

    public static function perform(): void
    {
        $rates = Review::getRateAverage();
        foreach ($rates as $rate)
        {
            ArticleRateUpdater::dispatch($rate);
        }
    }
}
