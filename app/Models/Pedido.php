<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\u;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'empresa_id',
        'user_id',
        'endereco_id',
        'tipo_pedido',
        'numero_pedido',
        'numero_pessoas',
        'nome',
        'telefone',
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

    public function detalhes()
    {
        return $this->hasMany(ProdutosPedido::class, 'pedido_id')
            ->with('cardapio');
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public static function createPedido($data, $tipo, $user, $empresa)
    {

        $pedido = Pedido::create([
            'empresa_id' => $empresa->empresa->id,
            'tipo_pedido' => $tipo,
            'telefone' => '(98) 98256-5099',
            'numero_pedido' => Helper::generateNumber(4),
            'nome' => $user->name,
            'status_pedido' => 'Pedido Efetuado'
        ]);

        foreach ($data as $value) {
            ProdutosPedido::create([
                'empresa_id' => $empresa->empresa->id,
                'pedido_id' => $pedido->id,
                'produto_id' => $value['id_produto'],
                'quantidade' => $value['quantidade'],
                'valor_unitario' => $value['produto']->valor,
                'valor_subtotal' => $value['produto']->valor * $value['quantidade'],
//                'observacoes'
            ]);
        }


    }

    public static function editPedido($value, $tipo, $user, $empresa)
    {

        $pedido = Pedido::query()
            ->where('user_id', $user->id)
            ->where('tipo_pedido', $tipo)
            ->orderBy('id', 'desc')
            ->first();


        ProdutosPedido::create([
            'empresa_id' => $empresa->empresa->id,
            'pedido_id' => $pedido->id,
            'produto_id' => $value['id_produto'],
            'quantidade' => $value['quantidade'],
            'valor_unitario' => (double)$value['produto']->valor,
            'valor_subtotal' => number_format($value['produto']->valor * $value['quantidade']),
//                'observacoes'
        ]);


    }
}
