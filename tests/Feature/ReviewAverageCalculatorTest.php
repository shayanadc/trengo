<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Review;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewAverageCalculatorTest extends TestCase
{
    use DatabaseMigrations, WithFaker;
    /**
     * A basic feature test example.
     * @dataProvider reviewsArticleRateProvider
     * @return void
     */
    public function testReviewsRateAverage($assert, $expected)
    {
        $this->reviewDatasets($assert);
        $ratesAvg = Review::getRateAverage();
        $this->assertSame(
            $expected,
            $ratesAvg
        );

    }
    public function reviewsArticleRateProvider() : array
    {
        return [
            [
                [
                    [['rate' => 4.5, 'count' => 20]],
                    [['rate' => 5, 'count' => 1]],
                    [['rate' => 4, 'count' => 100]],
                    [['rate' => 3, 'count' => 20]],
                ],
                [
                    ['article_id' => 1, 'real_stars' => 4.14],
                    ['article_id' => 2, 'real_stars' => 3.97],
                    ['article_id' => 3, 'real_stars' => 3.98],
                    ['article_id' => 4, 'real_stars' => 3.6],
                ]

            ],
            [
                [
                    [['rate' => 5, 'count' => 200]],
                    [['rate' => 5, 'count' => 1]],
                ],
                [
                    ['article_id' => 1, 'real_stars' => 5],
                    ['article_id' => 2, 'real_stars' => 5],
                ]

            ],
            [
                [
                    [['rate' => 5, 'count' => 20]],
                    [['rate' => 5, 'count' => 1]],
                    [['rate' => 1, 'count' => 50]],
                ],
                [
                    ['article_id' => 1, 'real_stars' => 3.49],
                    ['article_id' => 2, 'real_stars' => 2.3],
                    ['article_id' => 3, 'real_stars' => 1.37],
                ]
            ],
            [
                [
                    [['rate' => 5, 'count' => 260], ['rate' => 4, 'count' => 50]],
                    [['rate' => 5, 'count' => 1]],
                    [['rate' => 1, 'count' => 1]],
                ],
                [
                    ['article_id' => 1, 'real_stars' => 4.84],
                    ['article_id' => 2, 'real_stars' => 4.83],
                    ['article_id' => 3, 'real_stars' => 4.79],
                ]
            ],
        ];
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
