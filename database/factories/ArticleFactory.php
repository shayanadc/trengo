<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    public static function save($articleAttributes)
    {
        $categoryIds = $articleAttributes['categories'] ?? [];
        $categoryIds = Category::existed($categoryIds)->get('id')->pluck('id');

        return DB::transaction(function () use ($articleAttributes, $categoryIds) {

            $article = Article::create($articleAttributes);
            $article->setCategories($categoryIds);

            return $article;

        });
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'rate' => $this->faker->randomFloat(1,5)
        ];
    }
}
