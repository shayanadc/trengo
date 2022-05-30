<?php

namespace Tests\Feature;

use App\Jobs\ViewArticle;
use App\Models\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class ArticleViewEventTest extends TestCase
{
    use DatabaseMigrations;
    /***
     * @return void
     */
    public function testEventCallAfterArticleView()
    {
        Bus::fake();

        $article = Article::factory()->create();

        $this->get('/api/articles/'. $article->id);

        Bus::assertDispatchedAfterResponse(ViewArticle::class);
    }

    /**
     * @return void
     */
    public function testNotEventCallAfterFailingArticleView()
    {
        Bus::fake();

        $this->get('/api/articles/11');

        Bus::assertNotDispatchedAfterResponse(ViewArticle::class);

    }

    /**
     * @return void
     */
    public function testInsertingNewViewsInDBAfterViewArticleEventCall()
    {
        $article = Article::factory()->create();

        $this->get('/api/articles/'. $article->id);

        $this->assertDatabaseHas('real_time_views', [
            'article_id' => $article->id,
            'ip' => '127.0.0.1'
        ]);

    }


}
