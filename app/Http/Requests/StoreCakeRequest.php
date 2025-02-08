<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCakeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'weight' => 'required|integer|min:1',
            'value' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ];
    }
}