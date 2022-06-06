<?php

namespace App\Services\Review\Contracts;


interface ArticleRateSyncContract
{
    public static function sync(array $review) : void;

}
