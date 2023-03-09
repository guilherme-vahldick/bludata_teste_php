<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidaCnpjRule;
use App\Rules\ValidaCpfRule;

class CreateFornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'empresa_id' => 'required',
            'data_nascimento' => 'sometimes|nullable|date',
            'cpf' => [
                'sometimes',
                'nullable',
                new ValidaCpfRule()
            ],
            'cnpj' => [
                'sometimes',
                'nullable',
                new ValidaCnpjRule()
            ]
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O Título é obrigatório!',
            'estado_id.required' => 'O Estado é obrigatório!',
        ];
    }
}
