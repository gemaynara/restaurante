<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table = 'movimentacoes';

    protected $fillable = [
        'usuario_id',
        'empresa_id',
        'identificador',
        'tipo_identificacao', //pedido, nota, pagamento
        'valor_total',
        'valor_pago',
        'valor_troco',
        'tipo_movimentacao', //entrada ou saida
        'forma_pagamento',
        'descricao'
    ];

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
