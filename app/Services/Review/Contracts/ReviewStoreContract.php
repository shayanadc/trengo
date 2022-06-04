<?php

namespace App\Services\Review\Contracts;

use App\Models\Article;
use App\Models\Review;

interface ReviewStoreContract
{
    /**
     * @param array $body
     * @return Review
     */
    public function store(Article $article, array $body) : Review;

}
