<?php

namespace App\Services\RealTimeView\Concretes;

use App\Jobs\ViewSnapshot;
use App\Models\RealTimeView;
use App\Services\RealTimeView\Contracts\DailyViewSnapshotContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class DailyViewSnapshot implements DailyViewSnapshotContract
{
    public static Carbon $carbon;

    public function __construct(Carbon $carbon)
    {
        static::$carbon = $carbon;
    }


    public static function perform(): void
    {
        $YesterdayViewsChunks = self::getYesterdayViewsChunks();

        foreach ($YesterdayViewsChunks as $chunk)
        {
            ViewSnapshot::dispatch($chunk->toArray());
        }
    }

    /**
     * @return mixed
     */
    public static function getYesterdayViewsChunks() : Collection
    {
        return self::getYesterdayViews()->chunk(100);
    }

    /**
     * @return mixed
     */
    public static function getYesterdayViews() : Collection
    {
        return RealTimeView::viewedAt(static::$carbon->yesterday())
            ->groupByArticle()
            ->get();
    }

}
