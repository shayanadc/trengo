<?php

namespace App\Rules;

use App\Models\Rate;
use Illuminate\Contracts\Validation\Rule;

class ArticleRateUniqueIp implements Rule
{
    public string $ip;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $ip)
    {
        $this->ip = $ip;
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
        return !Rate::where('article_id', $value)->where('ip', $this->ip)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The validation error message.';
    }
}
