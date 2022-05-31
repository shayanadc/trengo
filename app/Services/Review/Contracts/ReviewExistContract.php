<?php

namespace App\Services\Review\Contracts;


interface ReviewExistContract
{
    public function getOne(string $article, string $ip) : bool;

}
