<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdicionalPedido extends Model
{
    use HasFactory;

    protected $table = 'adicionais_pedido';

    protected $fillable = [
        'empresa_id',
        'produto_pedido_id',
        'adicional_id',
        'quantidade',
        'valor_unitario',
        'subtotal'
    ];

    public function adicionalPedido(){
        return $this->belongsTo(AdicionalCardapio::class, 'adicional_id');
    }

}
