<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaCardapio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categoria_cardapios';

    protected $fillable = [
        'empresa_id',
        'nome',
        'descricao',
        'icone'
    ];
}
