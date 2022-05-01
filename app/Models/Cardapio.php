<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cardapio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cardapios';

    protected $fillable = [
        'empresa_id',
        'categoria_cardapio_id',
        'subcategoria_cardapio_id',
        'setor_id',
        'nome',
        'descricao',
        'imagem',
        'valor',
        'medida',
        'quantidade_servida',
        'tempo_preparo',
        'contador_pedidos',
        'ativo',
    ];
}
