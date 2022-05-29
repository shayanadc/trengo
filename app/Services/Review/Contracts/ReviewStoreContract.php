<?php

namespace App\Services\Review\Contracts;

use App\Models\Review;

interface ReviewStoreContract
{
    /**
     * @param array $body
     * @return Review
     */
    public function store(array $body) : Review;

}
