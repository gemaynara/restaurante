<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
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
        switch ($this->method()) {
            case 'PUT':
                $rules = [
                    'razao_social' => 'required|max:50',
                    'cnpj' => 'nullable|cnpj|unique:fornecedores,id,:id',
                    'email'=>'email',
                    'endereco'=>'string|max:200|nullable',
                    'bairro'=>'string|max:100|nullable',
                    'cep'=> 'string|max:9|nullable',
                    'telefone'=>'string|max:18|nullable',
                    'cidade'=>'string|max:20|nullable',
                    'estado'=>'string|max:2|nullable',

                ];
                break;

            default:
                $rules = [
                    'razao_social' => 'required|max:50',
                    'cnpj' => 'nullable|cnpj|unique:fornecedores,empresa_id',
                    'email'=>'email',
                    'endereco'=>'string|max:200|nullable',
                    'bairro'=>'string|max:100|nullable',
                    'cep'=> 'string|max:9|nullable',
                    'telefone'=>'string|max:18|nullable',
                    'cidade'=>'string|max:20|nullable',
                    'estado'=>'string|max:2|nullable',
                ];
                break;
        }

        return $rules;
    }
}
