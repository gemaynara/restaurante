<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    use HasFactory;
    protected $table= 'saidas';
    protected $fillable = [
        'empresa_id',
        'usuario_id',
        'observacoes',
        'situacao',
    ];

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function detalhes(){
        return $this->hasMany(ProdutosSaida::class, 'saida_id')
            ->with('produtos');
    }
}
