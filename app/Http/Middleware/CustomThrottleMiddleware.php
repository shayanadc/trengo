<?php

namespace App\Http\Middleware;

use App\Models\Review;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Cache;

class CustomThrottleMiddleware
{

    public function handle($request, Closure $next)
    {
        $userIp = $request->ip();

//        dd(Carbon::now()->endOfDay()->diffInSeconds(Carbon::now()));
        $cache = Cache::remember('posted_reviews_' . $userIp, 3600, function () use($userIp) {

            return Review::ip($userIp)->whereDay('created_at', Carbon::now())->pluck('created_at')->toArray();

        });
        if(count($cache) >= 8)
        {
            throw new ThrottleRequestsException('Too Many Attempts.');
        }
        return $next($request);

    }

}
