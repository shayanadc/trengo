<?php

namespace App\Services\RealTimeView\Contracts;

use App\Models\Article;

interface ViewProcessorContract
{
    public function store(Article $article, string $ip) : void;

}
