<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'setores';

    protected $fillable = [
        'empresa_id',
        'nome',
        'descricao'
    ];

    public static function listaSetores()
    {
        return Setor::query()->where('empresa_id', auth()->user()->empresa->id)
            ->get();
    }
}
