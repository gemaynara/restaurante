<?php

namespace App\Http\Services;

use App\Helpers\Helper;
use App\Models\AdicionalPedido;
use App\Models\Pedido;
use App\Models\ProdutosPedido;
use Illuminate\Support\Facades\DB;

class PedidoService
{
    public static function createOrUpdatePedido($value, $tipo, $user, $empresa)
    {

        $pedido = Pedido::query()
            ->firstOrCreate(
                ['empresa_id' => $empresa->empresa->id,
                    'usuario_id' => $user->id, 'tipo_pedido' => $tipo,
                    'status_pedido' => 'Pedido Efetuado'],
                ['empresa_id' => $empresa->empresa->id,
                    'usuario_id' => $user->id,
                    'tipo_pedido' => $tipo,
                    'numero_pedido' => Helper::generateNumber(4),
                    'nome' => $user->name,
                    'status_pedido' => 'Pedido Efetuado'
                ]);

        if (!is_null($value)) {
            $produto = ProdutosPedido::create([
                'empresa_id' => $empresa->empresa->id,
                'pedido_id' => $pedido->id,
                'produto_id' => $value['id_produto'],
                'quantidade' => $value['quantidade'],
                'valor_unitario' => (double)$value['produto']->valor,
                'valor_subtotal' => number_format($value['produto']->valor * $value['quantidade']),
                'observacoes' => $value['observacoes']
            ]);

            $adicionais = 0.00;
            if (isset($value['adicionais'])) {
                foreach ($value['adicionais'] as $key => $value) {
                    $adicional = explode("_", $value);
                    AdicionalPedido::query()->create([
                        'empresa_id' => $empresa->empresa->id,
                        'produto_pedido_id' => $produto->id,
                        'adicional_id' => $adicional[0],
                        'quantidade' => 1,
                        'valor_unitario' => $adicional[1],
                        'subtotal' => 1 * $adicional[1]
                    ]);

                    $adicionais += $adicional[0] * $adicional[1];
                }
            }

            $subtotal = $produto->valor_subtotal;

            $pedido->update(['subtotal' => DB::raw('subtotal+' . $subtotal),
                'adicionais' => DB::raw('adicionais+' . $adicionais)]);
        }

        return $pedido;
    }

    public static function createPedidoMesa($data)
    {
        return Pedido::query()
            ->firstOrCreate(
                ['empresa_id' => $data['empresa_id'], 'mesa_id' => $data['mesa_id'],
                    'tipo_pedido' => 'salao', 'status_pedido' => 'Comanda Aberta'],
                ['empresa_id' => $data['empresa_id'],
                    'mesa_id' => $data['mesa_id'],
                    'nome' => $data['nome'],
                    'tipo_pedido' => 'salao',
                    'operador_id' => auth()->user()->id,
                    'numero_pessoas' => $data['numero_pessoas'],
                    'numero_pedido' => Helper::generateNumber(4),
                    'status_pedido' => 'Comanda Aberta'
                ]);
    }

    public static function incrementContator($pedidos)
    {
        foreach ($pedidos as $item) {
            $item->cardapio->increment('contador_pedidos', $item->quantidade);
        }
    }

    public static function getPedidoUsuario($user)
    {

        return Pedido::with('detalhes', 'endereco')
            ->where('usuario_id', $user->id)
            ->orderBy('id', 'desc')
            ->first();

    }

    public static function listPedidos(array $status)
    {
        return Pedido::with('mesas')
            ->orderBy('id', 'desc')
            ->whereIn('status_pedido', $status)
            ->where('empresa_id', auth()->user()->empresa->id)
            ->get();
    }

    public static function countPedidos(array $status)
    {
        return Pedido::with('mesas')
            ->orderBy('id', 'desc')
            ->whereIn('status_pedido', $status)
            ->where('empresa_id', auth()->user()->empresa->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->count();
    }

    public static function getPedidoMesa($id)
    {
        return Pedido::with('detalhes', 'mesas')
            ->where('numero_pedido', $id)
            ->orderBy('id', 'desc')
            ->first();

    }


}
