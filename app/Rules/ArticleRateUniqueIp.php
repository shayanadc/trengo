<?php

namespace App\Rules;

use App\Services\Review\Contracts\ReviewExistContract;
use Illuminate\Contracts\Validation\Rule;

class ArticleRateUniqueIp implements Rule
{
    public string $ip;

    public ReviewExistContract $reviewService;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(ReviewExistContract $reviewStoreContract, string $ip)
    {
        $this->ip = $ip;
        $this->reviewService = $reviewStoreContract;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->reviewService->getOne($value, $this->ip);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'You have already registered your reviews to this article!';
    }
}
