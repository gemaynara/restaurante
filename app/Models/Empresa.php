<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'razao_social',
        'cnpj',
        'email',
        'endereco',
        'bairro',
        'cep',
        'telefone',
        'cidade',
        'estado',
        'ativo'
    ];

    public function parametros(){
        return $this->hasOne(EmpresaParametros::class, 'empresa_id');
    }

}
