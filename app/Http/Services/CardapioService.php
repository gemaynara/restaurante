<?php

namespace App\Http\Services;

use App\Helpers\Helper;
use App\Models\AdicionalCardapio;
use App\Models\AdicionalPedido;
use App\Models\Pedido;
use App\Models\ProdutosPedido;
use Illuminate\Support\Facades\DB;

class CardapioService
{
    public static function addItem($data)
    {
        $produto = ProdutosPedido::create([
            'empresa_id' => $data['empresa_id'],
            'pedido_id' => $data['pedido_id'],
            'produto_id' => $data['id_produto'],
            'quantidade' => $data['quantidade'],
            'valor_unitario' => (double)$data['valor'],
            'valor_subtotal' => number_format($data['valor'] * $data['quantidade']),
            'observacoes' => $data['observacoes']
        ]);

        $adicionais = 0.00;
        if (isset($data['adicionais'])) {
            foreach ($data['adicionais'] as $key => $value) {
                $adicional = explode("_", $value);
                AdicionalPedido::query()->create([
                    'empresa_id' => $data['empresa_id'],
                    'produto_pedido_id' => $produto->id,
                    'adicional_id' => $adicional[0],
                    'quantidade' => 1,
                    'valor_unitario' => $adicional[1],
                    'subtotal' => 1 * $adicional[1]
                ]);

                $adicionais += 1 * $adicional[1];
            }
        }

        $subtotal = $produto->valor_subtotal;

        $pedido = Pedido::query()->where('numero_pedido', $data['numero_pedido'])
            ->first();

        $vlSubtotal = $pedido->subtotal;
        $vlAdicionais = $pedido->adicionais;

        $valor = $vlSubtotal + $vlAdicionais + $subtotal + $adicionais;
        $vlTaxa = Helper::getAmountTaxa($valor);
        $total = (double)($valor) + (double)$vlTaxa;

        $pedido->update(['subtotal' => DB::raw('subtotal+' . $subtotal),
            'adicionais' => DB::raw('adicionais+' . $adicionais), 'taxa' => $vlTaxa, 'total' => $total]);


    }

    public static function editItem($data)
    {

        $produto = ProdutosPedido::where('id', $data['id'])
            ->where('pedido_id', $data['pedido_id'])
            ->where('empresa_id', $data['empresa_id'])
            ->where('produto_id', $data['id_produto'])
            ->first();

        $adicionais = $produto->adicionais->sum('subtotal');
        $valorProduto = $produto->valor_subtotal;

        $pedido = Pedido::where('id', $produto->pedido_id)
            ->first();

        $vlSubtotal = $pedido->subtotal;
        $vlAdicionais = $pedido->adicionais;

        $valor = ($vlSubtotal + $vlAdicionais) - ($valorProduto + $adicionais);
        $vlTaxa = Helper::getAmountTaxa($valor);
        $total = (double)($valor) + (double)$vlTaxa;


        $pedido->update(['subtotal' => DB::raw('subtotal-' . $valorProduto),
            'adicionais' => DB::raw('adicionais-' . $adicionais), 'taxa' => $vlTaxa, 'total' => $total]);

        $produto->adicionais()->delete();

        $produto->update(['quantidade' => $data['quantidade'],
            'valor_unitario' => (double)$data['valor'],
            'valor_subtotal' => number_format($data['valor'] * $data['quantidade']),
            'observacoes' => $data['observacoes']]);

        $adicionais = 0.00;
        if (isset($data['adicionais'])) {
            foreach ($data['adicionais'] as $key => $value) {
                $adicional = explode("_", $value);
                AdicionalPedido::query()->create([
                    'empresa_id' => $data['empresa_id'],
                    'produto_pedido_id' => $produto->id,
                    'adicional_id' => $adicional[0],
                    'quantidade' => 1,
                    'valor_unitario' => $adicional[1],
                    'subtotal' => 1 * $adicional[1]
                ]);

                $adicionais += 1 * $adicional[1];
            }
        }

        $subtotal = $produto->valor_subtotal;

        $pedido = Pedido::query()->where('numero_pedido', $data['numero_pedido'])
            ->first();

        $vlSubtotal = $pedido->subtotal;
        $vlAdicionais = $pedido->adicionais;

        $valor = $vlSubtotal + $vlAdicionais + $subtotal + $adicionais;
        $vlTaxa = Helper::getAmountTaxa($valor);
        $total = (double)($valor) + (double)$vlTaxa;

        $pedido->update(['subtotal' => DB::raw('subtotal+' . $subtotal),
            'adicionais' => DB::raw('adicionais+' . $adicionais), 'taxa' => $vlTaxa, 'total' => $total]);


    }

    public static function getAdicionaisProduto($id)
    {
        return AdicionalCardapio::where('subcategoria_cardapio_id', $id)
            ->get();
    }

    public static function getAdicionaisPedido($id)
    {
        return AdicionalPedido::query()
            ->where('produto_pedido_id', $id)
            ->pluck('adicional_id', 'adicional_id');

    }
}
