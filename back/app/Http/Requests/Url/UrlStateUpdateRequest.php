<?php

namespace App\Http\Requests\Url;

use App\Enums\UrlStates;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UrlStateUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:url',
            'state' => ['required','string',Rule::in(UrlStates::states())],
        ];
    }
}
