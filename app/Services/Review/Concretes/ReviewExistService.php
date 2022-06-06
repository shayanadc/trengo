<?php

namespace App\Services\Review\Concretes;

use App\Models\Review;
use App\Services\Review\Contracts\ReviewExistContract;
use Illuminate\Support\Facades\Cache;

class ReviewExistService implements ReviewExistContract
{
    public function getOne(string $article, string $ip) : bool
    {
        $articlesReviewed = Cache::remember('articles_reviewed_' . $ip, 3600, function () use ($ip) {

            return Review::ip($ip)->get('article_id')->pluck('article_id')->toArray();

        });

        return !in_array(intval($article), $articlesReviewed);


    }

}
