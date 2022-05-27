<?php

namespace App\Services\Article;

use App\Services\Article\Concretes\ArticleStoreService;
use App\Services\Article\Contracts\ArticleStoreContract;
use App\Services\Cycle\Concretes\CycleService;
use App\Services\Cycle\Contracts\CycleServiceContract;
use Carbon\Laravel\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ArticleStoreContract::class,
            ArticleStoreService::class
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
