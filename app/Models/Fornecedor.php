<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fornecedores';

    protected $fillable = [
        'empresa_id',
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
}
