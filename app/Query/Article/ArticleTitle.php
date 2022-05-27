<?php

namespace App\Query\Article;

class ArticleTitle
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('title')) {
            return $next($request);
        }
        $builder = $next($request);
        return $builder->title(request('title'));
    }
}
