<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Review;
use App\Models\View;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()->count(1000)->create([
            'title' => Factory::create()->title,
            'rate' => Factory::create()->randomDigit(),
            'body' => Factory::create()->sentence(),
        ])->each(function ($article){
            Category::factory()->create(['name' => rand()]);
            View::factory()->create(['article_id' => $article->id, 'count' => rand(1,10)]);
            Review::factory()->create(['article_id' => $article->id, 'ip' => Factory::create()->unique()->ipv4(),'rate' => rand(1,5)]);
        });
    }
}
