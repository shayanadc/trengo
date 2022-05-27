<?php

namespace App\Services\Article\Contracts;

use Illuminate\Support\Collection;

interface ArticleListingContract
{
    public function getMany() : Collection;
}
