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
        \Carbon\Carbon::setTestNow("2020-01-01 23:59:00");
        $article = Article::factory()->create(['title' => 'agag']);
        $review = Review::create(['article_id' => $article->id, 'rate' => 5, 'ip' => '127.0.0.1']);

        Cache::shouldReceive('get')->with('posted_reviews_'. $review->ip)->andReturn(0);

        Cache::spy();

        Cache::shouldReceive('put')->with('posted_reviews_'. $review->ip, 1, 59);
    }
}
