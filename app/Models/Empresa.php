<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'empresas';

    protected $fillable = [
        'razao_social',
        'cnpj',
        'email',
        'endereco',
        'complemento',
        'cep',
        'telefone',
        'cidade',
        'estado',
        'ativo'
    ];
}
