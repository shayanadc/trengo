<?php

namespace App\Http\Middleware;

use App\Models\Review;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Cache;

class ReviewCreationLimit
{

    public function handle($request, Closure $next)
    {
        $userIp = $request->ip();

        $remainingSecondsToEndDay = Carbon::now()->endOfDay()->diffInSeconds(Carbon::now());
        $todayPostedReviews = Cache::remember('posted_reviews_' . $userIp, $remainingSecondsToEndDay, function () use($userIp) {

            return Review::ip($userIp)->whereDay('created_at', Carbon::now())->count();

        });

        if($todayPostedReviews >= 8)
        {
            throw new ThrottleRequestsException('Too Many Attempts.');
        }

        return $next($request);

    }

}
