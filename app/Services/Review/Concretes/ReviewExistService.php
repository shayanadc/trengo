<?php

namespace App\Services\Review\Concretes;

use App\Models\Article;
use App\Models\Review;
use App\Services\Review\Contracts\ReviewExistContract;
use App\Services\Review\Contracts\ReviewStoreContract;

class ReviewExistService implements ReviewExistContract
{
    public function getOne(string $article, string $ip) : bool
    {
        return !Review::article($article)->ip($ip)->first();
    }

}
