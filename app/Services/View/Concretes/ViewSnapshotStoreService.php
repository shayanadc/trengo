<?php

namespace App\Services\View\Concretes;

use App\Models\View;
use App\Services\View\Contracts\ViewSnapshotStoreContract;

class ViewSnapshotStoreService implements ViewSnapshotStoreContract
{
    public function insertMany(array $arr): void
    {
        View::insert($arr);
    }
}
