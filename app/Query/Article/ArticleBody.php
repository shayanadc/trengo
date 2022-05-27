<?php

namespace App\Query\Article;

class ArticleBody
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('body')) {
            return $next($request);
        }
        $builder = $next($request);
        return $builder->body(request('body'));
    }
}
