<?php

namespace App\Query\Article;

class ArticleRate
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('rate')) {
            return $next($request);
        }

        $builder = $next($request);

        return $builder->rate();
    }
}
