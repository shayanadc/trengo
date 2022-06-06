<?php

namespace App\Services\Review\Concretes;

use App\Jobs\ArticleRateUpdater;
use App\Models\Review;
use App\Services\Review\Contracts\ArticleRateCollectorContract;

class ArticleReviewCollectorService implements ArticleRateCollectorContract
{

    public static function perform(): void
    {
        $rates = Review::getRateAverage();

        array_map(function($rate) {

            ArticleRateUpdater::dispatch($rate);

        }, $rates);
    }
}
