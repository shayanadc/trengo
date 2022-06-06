<?php

namespace App\Services\RealTimeView\Concretes;

use App\Jobs\ViewSnapshot;
use App\Models\RealTimeView;
use App\Services\RealTimeView\Contracts\ViewSnapshotAggregatorContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ViewSnapshotAggregatorAggregatorService implements ViewSnapshotAggregatorContract
{
    public static Carbon $datetime;

    public function __construct(Carbon $carbon)
    {
        static::$datetime = $carbon;
    }


    public static function perform(): void
    {
        $YesterdayViewsChunks = self::getRealTimeViewsChunks();

        foreach ($YesterdayViewsChunks as $chunk)
        {
            ViewSnapshot::dispatch($chunk->toArray());
        }
    }

    /**
     * @return mixed
     */
    public static function getRealTimeViewsChunks($chunk = 100) : Collection
    {
        return self::yesterdayTotalRealTimeViewsGroupByArticle()->chunk($chunk);
    }

    /**
     * @return mixed
     */
    public static function yesterdayTotalRealTimeViewsGroupByArticle() : Collection
    {
        return RealTimeView::viewedAt(static::$datetime->yesterday())
            ->groupByArticle()
            ->get();
    }

}
