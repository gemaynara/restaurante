<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'empresa_id',
        'mesa_id',
        'usuario_id',
        'endereco_id',
        'tipo_pedido',
        'numero_pedido',
        'numero_pessoas',
        'nome',
        'cpf',
        'email',
        'subtotal',
        'adicionais',
        'taxa',
        'desconto',
        'total',
        'status_pedido'
    ];

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mesas()
    {
        return $this->belongsTo(Mesa::class, 'mesa_id', 'id');
    }

    public function detalhes()
    {
        return $this->hasMany(ProdutosPedido::class, 'pedido_id')
            ->with('cardapio', 'adicionais');
    }


    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }


}
