<?php

namespace App\Services\Rate;

use App\Services\Rate\Concretes\StoreRateService;
use App\Services\Rate\Contracts\StoreRateContract;
use Carbon\Laravel\ServiceProvider;

class RateServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            StoreRateContract::class,
            StoreRateService::class
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
