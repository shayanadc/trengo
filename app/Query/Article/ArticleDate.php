<?php

namespace App\Query\Article;

class ArticleDate
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('date')) {
            return $next($request);
        }

        $builder = $next($request);

        $dateRange = explode(",", request('date'));

        return $builder->createdAtRange($dateRange);
    }
}
