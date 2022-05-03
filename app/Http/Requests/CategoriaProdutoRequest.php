<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaProdutoRequest extends FormRequest
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
                    'nome' => 'required|max:40|unique:categoria_produtos,id,:id',
                    'descricao' => 'max:200'
                ];
                break;

            default:
                $rules = [
                    'nome' => 'required|max:40|unique:categoria_produtos,empresa_id',
                    'descricao' => 'max:200',
                ];
                break;
        }

        return $rules;
    }
}
