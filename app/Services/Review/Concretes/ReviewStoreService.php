<?php

namespace App\Services\Review\Concretes;

use App\Models\Article;
use App\Models\Review;
use App\Services\Review\Contracts\ReviewStoreContract;

class ReviewStoreService implements ReviewStoreContract
{
    /**
     * @param array $body
     * @return mixed
     */
    public function store(array $body) : Review
    {
        Article::findOrFail($body['article_id']);

        return Review::create($body);
    }

}
