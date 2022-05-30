<?php

namespace App\Providers;

use App\Jobs\ViewArticle;
use App\Jobs\ViewSnapshot;
use App\Models\Review;
use App\Services\Article\Concretes\ArticleStoreService;
use App\Services\Article\Contracts\ArticleStoreContract;
use App\Services\RealTimeView\Concretes\ViewProcessorService;
use App\Services\RealTimeView\Contracts\ViewProcessorContract;
use App\Services\View\Concretes\ViewAggregatesStoreService;
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
        $this->app->bindMethod([ViewArticle::class, 'handle'], function ($job, $app) {
            return $job->handle($app->make(ViewProcessorService::class));
        });

        $this->app->bindMethod([ViewSnapshot::class, 'handle'], function ($job, $app) {
            return $job->handle($app->make(ViewAggregatesStoreService::class));
        });
    }
}
