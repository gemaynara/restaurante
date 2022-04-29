<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoriaCardapioRequest extends FormRequest
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
                    'categoria_cardapio_id' => 'required',
                    'nome' => 'required|max:40|unique:sub_categoria_cardapios,id,:id',
                    'descricao' => 'max:200'
                ];
                break;

            default:
                $rules = [
                    'categoria_cardapio_id' => 'required',
                    'nome' => 'required|max:40|unique:sub_categoria_cardapios,empresa_id',
                    'descricao' => 'max:200'
                ];
                break;
        }

        return $rules;
    }
}
