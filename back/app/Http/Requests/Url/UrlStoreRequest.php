<?php

namespace App\Http\Requests\Url;

use Illuminate\Foundation\Http\FormRequest;

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
