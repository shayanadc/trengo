<?php

namespace App\Query\Article;

class ArticleView
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('views')) {
            return $next($request);
        }

        $builder = $next($request);

        return $builder->view();
    }
}
