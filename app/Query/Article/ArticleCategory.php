<?php

namespace App\Query\Article;

class ArticleCategory
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('categories')) {
            return $next($request);
        }
        $builder = $next($request);

        $categoryIds = explode(",", request('categories'));

        return $builder->categories($categoryIds);
    }
}
