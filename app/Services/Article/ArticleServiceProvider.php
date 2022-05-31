<?php

namespace App\Services\Article;

use App\Services\Article\Concretes\ArticleListingService;
use App\Services\Article\Concretes\ArticleShowingService;
use App\Services\Article\Concretes\ArticleStoreService;
use App\Services\Article\Contracts\ArticleListingContract;
use App\Services\Article\Contracts\ArticleShowingContract;
use App\Services\Article\Contracts\ArticleStoreContract;
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

        $this->app->bind(
            ArticleListingContract::class,
            ArticleListingService::class
        );

        $this->app->bind(
            ArticleShowingContract::class,
            ArticleShowingService::class
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
