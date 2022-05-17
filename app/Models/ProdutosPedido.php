<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosPedido extends Model
{
    use HasFactory;

    protected $table = 'produtos_pedido';

    protected $fillable = [
        'empresa_id',
        'pedido_id',
        'produto_id',
        'quantidade',
        'valor_unitario',
        'valor_subtotal',
        'observacoes'
    ];

    public function cardapio(){
        return $this->belongsTo(Cardapio::class, 'produto_id');
    }

    public function adicionais(){
        return $this->hasMany(AdicionalPedido::class, 'produto_pedido_id')
            ->with('adicionalPedido');
    }
}
