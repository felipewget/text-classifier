<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassifyTextRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phrase' => 'required|string|max:255',
        ];
    }
}
