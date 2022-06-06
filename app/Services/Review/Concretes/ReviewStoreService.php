<?php

namespace App\Services\Review\Concretes;

use App\Models\Article;
use App\Models\Review;
use App\Services\Review\Contracts\ReviewStoreContract;
use App\Services\Review\Exceptions\ReviewUniqueConstraint;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewStoreService implements ReviewStoreContract
{
    /**
     * @param array $body
     * @return mixed
     */
    public function store(Article $article, array $body) : Review
    {
        $body['article_id'] = $article->id;
        $review = $article->reviews()->where('ip', $body['ip'])->first();
        if($review){
            throw new ReviewUniqueConstraint('you have registered the review for this article!', 402);
        }
        return Review::create($body);
    }

}
