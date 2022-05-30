<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\RealTimeView;
use App\Models\View;
use App\Services\RealTimeView\Concretes\DailyViewSnapshot;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewSnapshotProcessorTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDailySnapshotView()
    {
        $article1 = Article::factory()->create();
        $article2 = Article::factory()->create();

        \Carbon\Carbon::setTestNow("2020-01-01");

        RealTimeView::factory()->create(['article_id' => $article2->id]);

        RealTimeView::factory()->count(4)->create(['article_id' => $article1->id]);

        \Carbon\Carbon::setTestNow("2020-01-02");

        $service = resolve(DailyViewSnapshot::class);

        $service::perform();

        $this->assertCount(1, View::where('article_id', $article1->id)->where('count', 4)->get());

        $this->assertCount(1, View::where('article_id', $article2->id)->where('count', 1)->get());

    }
}
