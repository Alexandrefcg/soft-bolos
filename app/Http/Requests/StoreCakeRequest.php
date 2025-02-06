<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCakeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permite que qualquer usuário faça a requisição
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
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

    /**
     * Custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'weight.required' => 'O campo peso é obrigatório.',
            'weight.integer' => 'O campo peso deve ser um número inteiro.',
            'weight.min' => 'O campo peso deve ser pelo menos 1 grama.',
            'value.required' => 'O campo valor é obrigatório.',
            'value.numeric' => 'O campo valor deve ser um número.',
            'value.min' => 'O campo valor não pode ser negativo.',
            'quantity.required' => 'O campo quantidade é obrigatório.',
            'quantity.integer' => 'O campo quantidade deve ser um número inteiro.',
            'quantity.min' => 'O campo quantidade não pode ser negativo.',
        ];
    }
}
