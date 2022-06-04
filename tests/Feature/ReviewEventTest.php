<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Review;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ReviewEventTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCallingTheCacheAfterCreatingAReview()
    {
//        Cache::spy();
//        $article = Article::create(['title' => 'agag']);
//        $review = Review::create(['article_id' => $article->id, 'rate' => 5, 'ip' => '127.0.0.1']);
//        Cache::shouldHaveReceived('put')->once()->with($review->ip, 1, 10);
    }
}
