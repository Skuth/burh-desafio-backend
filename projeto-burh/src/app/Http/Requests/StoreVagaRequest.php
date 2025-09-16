<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVagaRequest extends FormRequest
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
            'empresa_id' => ['required', 'exists:empresas,id'],
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'tipo' => ['required', 'in:PJ,CLT,E'],
            'salario' => ['numeric'],
            'horario' => ['numeric'],
        ];
    }
}
