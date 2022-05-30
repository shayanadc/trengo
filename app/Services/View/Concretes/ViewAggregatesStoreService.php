<?php

namespace App\Services\View\Concretes;

use App\Models\View;
use App\Services\View\Contracts\ViewAggregatorStoreContract;

class ViewAggregatesStoreService implements ViewAggregatorStoreContract
{
    public function insertMany(array $agg): void
    {
        View::insert($agg);
    }
}
