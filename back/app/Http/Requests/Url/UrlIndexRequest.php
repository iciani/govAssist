<?php

namespace App\Http\Requests\Url;

use App\Enums\UrlStates;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UrlIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'per_page' => 'sometimes|nullable|integer|min:1',
            'state' => ['sometimes','nullable','string',Rule::in(UrlStates::states())],
        ];
    }
}
