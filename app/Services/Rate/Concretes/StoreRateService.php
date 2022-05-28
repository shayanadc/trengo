<?php

namespace App\Services\Rate\Concretes;

use App\Models\Article;
use App\Models\Rate;
use App\Services\Rate\Contracts\StoreRateContract;

class StoreRateService implements StoreRateContract
{
    /**
     * @param array $body
     * @return mixed
     */
    public function store(array $body) : Rate
    {
        Article::findOrFail($body['article_id']);

        return Rate::create($body);
    }

}
