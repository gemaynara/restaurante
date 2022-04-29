<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategoriaCardapio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_categoria_cardapios';

    protected $primaryKey = 'id';
    protected $fillable = [
        'empresa_id',
        'categoria_cardapio_id',
        'nome',
        'descricao'
    ];

    public function categoriaCardapio()
    {
        return $this->belongsTo(CategoriaCardapio::class);
    }
}
