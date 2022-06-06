<?php

namespace App\Services\Article\Concretes;

use App\Models\RealTimeView;
use Illuminate\Support\Facades\Cache;

class ArticleSeen
{
    /**
     * @param $ip
     * @return mixed
     */
    public static function byIp($articleId, $ip): mixed
    {
        return Cache::remember('article_'.$articleId .'_seen_' . $ip, 86400, function () use ($ip, $articleId) {

            return (bool)RealTimeView::ip($ip)->article($articleId)->first();

        });
    }

}
