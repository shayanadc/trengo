<?php

namespace App\Http\Requests;

use App\Rules\ArticleRateUniqueIp;
use Illuminate\Foundation\Http\FormRequest;

class StoreRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'rate' => ['required','integer', 'between:1,5'],
            'article_id' => new ArticleRateUniqueIp($this->ip())
        ];
    }
}
