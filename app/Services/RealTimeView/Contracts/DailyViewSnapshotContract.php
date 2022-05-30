<?php

namespace App\Services\RealTimeView\Contracts;

interface DailyViewSnapshotContract
{
    public static function perform() : void;
}
