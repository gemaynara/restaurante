<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaProduto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categoria_produtos';

    protected $fillable = [
        'empresa_id',
        'nome',
        'icone'
    ];
}
