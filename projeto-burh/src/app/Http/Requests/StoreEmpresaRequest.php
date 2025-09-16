<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaRequest extends FormRequest
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
            'descricao' => ['required', 'string'],
            'cnpj' => ['required', 'string', 'size:14', 'unique:empresas'],
            'plano' => ['required', 'in:F,P'],
        ];
    }

    public function messages(): array
    {
        return [
            'cnpj.unique' => 'O CNPJ ja esta em uso.',
        ];
    }
}
