<?php

namespace App\Services\Review;

use App\Models\Review;
use App\Services\Review\Concretes\ReviewExistService;
use App\Services\Review\Concretes\ReviewStoreService;
use App\Services\Review\Contracts\ReviewExistContract;
use App\Services\Review\Contracts\ReviewStoreContract;
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
            Cache::put($review->ip, 1, 10);
        });
    }

}
