<?php

namespace App\Services\Rate\Contracts;

use App\Models\Rate;

interface StoreRateContract
{
    /**
     * @param array $body
     * @return Rate
     */
    public function store(array $body) : Rate;

}
