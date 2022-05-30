<?php

namespace App\Services\View\Contracts;

interface ViewAggregatorStoreContract
{
    public function insertMany(array $array) : void;

}
