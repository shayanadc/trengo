<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Review;
use App\Services\Review\Concretes\ArticleReviewCollectorService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleReviewSyncTest extends TestCase
{
    use DatabaseMigrations, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $sample = [
            [['rate' => 4.5, 'count' => 20]],
            [['rate' => 5, 'count' => 1]],
            [['rate' => 4, 'count' => 100]],
            [['rate' => 3, 'count' => 20]],
        ];

        $this->reviewDatasets($sample);
        $service = resolve(ArticleReviewCollectorService::class);

        $service::perform();

        $this->assertDatabaseHas('articles', [
            'id' => 1,
            'rate' => 4.14
        ]);

        $this->assertDatabaseHas('articles', [
            'id' => 2,
            'rate' => 3.97
        ]);

        $this->assertDatabaseHas('articles', [
            'id' => 3,
            'rate' => 3.98
        ]);

        $this->assertDatabaseHas('articles', [
            'id' => 4,
            'rate' => 3.6
        ]);

    }

    public function reviewDatasets($arr)
    {
        foreach ($arr as $items)
        {
            $article = Article::factory()->create();

            foreach ($items as $item){
                Review::factory()
                    ->count($item['count'])
                    ->sequence(fn ($sequence) => ['ip' => $this->faker->ipv4()])
                    ->create(['rate' => $item['rate'], 'article_id' => $article->id]);
            }
        }
    }

}
