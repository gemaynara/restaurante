<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\ProdutosPedido;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProducaoController extends Controller
{
    public function producao($setor)
    {
        $setor = Setor::query()->where('nome', $setor)
            ->where('empresa_id', auth()->user()->empresa->id)
            ->first();

        $pedidos = Pedido::
            whereNotIn('status_pedido', ["Pedido $setor->nome Produzido", 'Pedido Finalizado', 'Pedido Finalizado', 'Aguardando Pagamento', 'Pedido Cancelado'])
            //            ->where('status_pedido', "<>", "Pedido {$setor} Produzido")
            ->with(['mesas', 'detalhes'])
            ->orderBy('pedidos.id', 'desc')
            ->get();

        return view('pages.admin.producao.em-producao', compact('pedidos', 'setor'));

    }

    public function confirmarPedido(Request $request, $id, $novoStatus)
    {

        try {
            DB::beginTransaction();
            $comanda = Pedido::query()->findOrFail($id);
            $comanda->status_pedido = $novoStatus;

            ProdutosPedido::query()
                ->join('cardapios', 'produtos_pedido.produto_id', 'cardapios.id')
                ->where('pedido_id', $comanda->id)
                ->where('enviado', 'S')
                ->where('produzido', 'N')
                ->where('setor_id', $request->setor)
                ->update(['produzido' => 'S']);


            Mesa::where('id', $comanda->mesa_id)->update(['situacao' => $novoStatus]);
            $comanda->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('erro ao alterar status: ' . $e->getMessage());
        }
    }
}
