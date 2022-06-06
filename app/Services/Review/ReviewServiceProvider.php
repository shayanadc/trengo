<?php

namespace App\Services\Review;

use App\Models\Review;
use App\Services\Review\Concretes\ReviewExistService;
use App\Services\Review\Concretes\ReviewStoreService;
use App\Services\Review\Contracts\ReviewExistContract;
use App\Services\Review\Contracts\ReviewStoreContract;
use Carbon\Carbon;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class ReviewServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            ReviewExistContract::class,
            ReviewExistService::class
        );

        $this->app->bind(
            ReviewStoreContract::class,
            ReviewStoreService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Review::created(function ($review) {
            $remainingTimeToEndDay = Carbon::now()->endOfDay()->diffInSeconds(Carbon::now());
            $cacheExist =  Cache::get('posted_reviews_'. $review->ip, 0);
            Cache::put('posted_reviews_'. $review->ip, $cacheExist + 1, $remainingTimeToEndDay);
        });
    }

}
