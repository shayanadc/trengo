<?php

namespace App\Providers;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

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
