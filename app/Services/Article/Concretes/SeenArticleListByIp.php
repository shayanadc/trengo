<?php

namespace App\Services\Article\Concretes;

use App\Models\RealTimeView;
use Illuminate\Support\Facades\Cache;

class SeenArticleListByIp
{
    /**
     * @param $ip
     * @return mixed
     */
    public static function getMany($ip): mixed
    {
        return Cache::remember('articles_seen_' . $ip, 3600, function () use ($ip) {

            return RealTimeView::ip($ip)->get('article_id')->pluck('article_id')->toArray();

        });
    }

}
