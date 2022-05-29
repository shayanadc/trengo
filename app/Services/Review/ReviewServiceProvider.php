<?php

namespace App\Services\Review;

use App\Services\Review\Concretes\ReviewStoreService;
use App\Services\Review\Contracts\ReviewStoreContract;
use Carbon\Laravel\ServiceProvider;

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

    }

}
