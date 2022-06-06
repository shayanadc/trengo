<?php

namespace App\Services\RealTimeView\Contracts;

interface ViewSnapshotAggregatorContract
{
    public static function perform() : void;
}
