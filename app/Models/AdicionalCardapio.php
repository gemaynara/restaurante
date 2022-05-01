<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdicionalCardapio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'adicionais_cardapio';

    protected $fillable = [
        'empresa_id',
        'subcategoria_cardapio_id',
        'nome',
        'valor'
    ];

    public function subCategoriaCardapio()
    {
        return $this->belongsTo(SubCategoriaCardapio::class, 'id');
    }
}
