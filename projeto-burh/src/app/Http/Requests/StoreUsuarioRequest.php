<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'data_nascimento' => ['date'],
            'cpf' => ['required', 'string', 'size:11', 'unique:usuarios'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'O email ja esta em uso.',
            'cpf.unique' => 'O CPF ja esta em uso.',
        ];
    }
}
