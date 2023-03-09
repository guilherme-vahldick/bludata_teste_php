<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidaCnpjRule;

class CreateEmpresaRequest extends FormRequest
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
            'estado_id' => 'required',
            'cnpj' => [
                'required',
                'unique:empresa,cnpj,' . ($this->empresa ? $this->empresa->id : null) . ',id',
                new ValidaCnpjRule()
            ]
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O Título é obrigatório!',
            'estado_id.required' => 'O Estado é obrigatório!',
            'cnpj.required' => 'O CNPJ é obrigatório!',
            'cnpj.unique' => 'O CNPJ informado já foi cadastrado anteriormente!'
        ];
    }
}
