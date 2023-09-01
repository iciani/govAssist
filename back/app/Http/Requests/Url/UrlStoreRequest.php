<?php

namespace App\Http\Requests\Url;

use App\Enums\UrlStates;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UrlStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'destination' => 'required|url',
            'description' => 'sometimes|nullable|string'
        ];
    }
}
