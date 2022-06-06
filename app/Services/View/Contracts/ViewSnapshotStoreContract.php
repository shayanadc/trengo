<?php

namespace App\Services\View\Contracts;

interface ViewSnapshotStoreContract
{
    public function insertMany(array $array) : void;

}
