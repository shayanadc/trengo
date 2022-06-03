<?php

namespace App\Providers;

use App\Jobs\ArticleRateUpdater;
use App\Jobs\ViewArticle;
use App\Jobs\ViewSnapshot;
use App\Services\RealTimeView\Concretes\ViewArticleArticleProcessorService;
use App\Services\Review\Concretes\ArticleRateSyncService;
use App\Services\View\Concretes\ViewSnapshotStoreService;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bindMethod([ViewArticle::class, 'handle'], function ($job, $app) {
            return $job->handle($app->make(ViewArticleArticleProcessorService::class));
        });

        $this->app->bindMethod([ViewSnapshot::class, 'handle'], function ($job, $app) {
            return $job->handle($app->make(ViewSnapshotStoreService::class));
        });

        $this->app->bindMethod([ArticleRateUpdater::class, 'handle'], function ($job, $app) {
            return $job->handle($app->make(ArticleRateSyncService::class));
        });
    }
}
