<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Services\CardapioService;
use App\Http\Services\ControleCaixaService;
use App\Http\Services\PedidoService;
use App\Models\Cardapio;
use App\Models\CategoriaCardapio;
use App\Models\Mesa;
use App\Models\Movimentacao;
use App\Models\Pedido;
use App\Models\ProdutosPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    public function listaMesas()
    {
        $mesas = Mesa::query()
            ->leftJoin('pedidos', 'pedidos.mesa_id', 'mesas.id')
            ->select('mesas.*', 'pedidos.numero_pedido')
            ->orderBy('codigo')->get();

        return view('pages.admin.pedidos.lista-mesas', compact('mesas'));
    }

    public function abrirComanda(Request $request)
    {
        try {
            $data = $request->except('_token');

            $data['empresa_id'] = auth()->user()->empresa->id;
            $pedido = PedidoService::createPedidoMesa($data);
            $pedido = PedidoService::getPedidoMesa($pedido->numero_pedido);

            Mesa::where('id', $pedido->mesas->id)
                ->where('empresa_id', $data['empresa_id'])
                ->update(['situacao' => 'Comanda Aberta']);

            return redirect()->to('cardapio/ver-cardapio/' . $pedido->numero_pedido);
        } catch (\Exception $e) {
            Log::info('Ocorreu um erro: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro');
        }


    }

    public function addItem(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['empresa_id'] = auth()->user()->empresa->id;
            $pedido = PedidoService::getPedidoMesa($data['numero_pedido']);
            $data['pedido_id'] = $pedido->id;
            CardapioService::addItem($data);

            $pedido->update(['status_pedido'=>'Comanda aberta']);
            $pedido->mesas->update(['situacao'=> 'Comanda Aberta']);
            $pedido = PedidoService::getPedidoMesa($pedido->numero_pedido);
            $categorias = CategoriaCardapio::where('empresa_id', $data['empresa_id'])->get();

            $cardapio = Cardapio::with('categoriasCardapio')
                ->where('empresa_id', $data['empresa_id']);

            $produtos = $cardapio->get();
            return redirect()->back()->with('success', 'Produto Inserido com sucesso')
                ->with('pedido', $pedido)->with('categorias', $categorias)
                ->with('produtos', $produtos);
        } catch (\Exception $e) {
            Log::info('Ocorreu um erro: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir.');
        }

    }

    public function editItem(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['empresa_id'] = auth()->user()->empresa->id;
            $pedido = PedidoService::getPedidoMesa($data['numero_pedido']);
            $data['pedido_id'] = $pedido->id;
            CardapioService::editItem($data);

            $pedido = PedidoService::getPedidoMesa($pedido->numero_pedido);
            $categorias = CategoriaCardapio::where('empresa_id', $data['empresa_id'])->get();

            $cardapio = Cardapio::with('categoriasCardapio')
                ->where('empresa_id', $data['empresa_id']);

            $produtos = $cardapio->get();
            return redirect()->back()->with('success', 'Produto Alterado  com sucesso')
                ->with('pedido', $pedido)->with('categorias', $categorias)
                ->with('produtos', $produtos);
        } catch (\Exception $e) {
            Log::info('Ocorreu um erro: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir.');
        }

    }

    public function removeItem($id)
    {
        $produto = ProdutosPedido::query()->with('adicionais')->find($id);

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
        $produto->delete();
    }

    public function enviarPedido(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['empresa_id'] = auth()->user()->empresa->id;
            $pedido = Pedido::query()->with('detalhes', 'mesas')
                ->where('numero_pedido', $data['numero_pedido'])
                ->first();
            $pedido->detalhes()->where('enviado', 'N')->update(['enviado' => 'S']);
            $pedido->mesas()->update(['situacao' => 'Pedido em Produção']);
            $pedido->update(['status_pedido' => 'Em Produção']);

            return redirect()->route('pedidos.mesas')->with('success', 'Pedido enviado para produção');
        } catch (\Exception $e) {
            Log::info('Ocorreu um erro: ' . $e->getMessage());
            return redirect()->route('pedidos.mesas')->with('error', 'Ocorreu um erro ao enviar pedido.');
        }
    }

    public function encerrarPedido(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['empresa_id'] = auth()->user()->empresa->id;
            $pedido = Pedido::query()->with('detalhes', 'mesas')
                ->where('numero_pedido', $data['numero_pedido'])
                ->first();

            $pedido->mesas()->update(['situacao' => 'Comanda Encerrada']);
            $pedido->update(['status_pedido' => 'Comanda Encerrada']);

            return redirect()->route('pedidos.mesas')->with('success', 'Comanda encerrada com sucesso');
        } catch (\Exception $e) {
            Log::info('Ocorreu um erro: ' . $e->getMessage());
            return redirect()->route('pedidos.mesas')->with('error', 'Ocorreu um erro ao encerrar o  pedido.');
        }
    }


    public function pedidos()
    {
        $pedidos = Pedido::with('mesas')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.admin.pedidos.index', compact('pedidos'));
    }

    public function pedidosRecebidos()
    {
        $pedidos = Pedido::with('mesas')
            ->orderBy('id', 'desc')
            ->whereIn('status_pedido', ['Pedido Efetuado', 'Em Produção', 'Comanda Encerrada'])
            ->orWhere('status_pedido', 'LIKE', '%Produzido')
            ->get();

        return view('pages.admin.pedidos.recebidos', compact('pedidos'));
    }

    public function pedidosFinalizados()
    {
        $pedidos = Pedido::with('mesas')
            ->orderBy('id', 'desc')
            ->whereIn('status_pedido', ['Comanda Encerrada'])
            ->get();

        return view('pages.admin.pedidos.encerrados', compact('pedidos'));
    }

    public function verPedido($id)
    {
        $pedido = Pedido::with('detalhes', 'mesas','endereco')
            ->find($id);

        $existeCaixa = ControleCaixaService::getCaixa();
        $movimentacoes = Movimentacao::query()->where('identificador', (int)$id)
            ->where('tipo_identificacao', 'PEDIDO')
            ->get();

        return view('pages.admin.pedidos.show', compact('pedido', 'movimentacoes', 'existeCaixa'));
    }

    public function imprimirComanda($id)
    {
        $pedido = PedidoService::getPedidoMesa($id);

        return view('prints.comanda', compact('pedido'));
    }

    public function imprimirCupom($id)
    {

        $pedido = PedidoService::getPedidoMesa($id);

        $movimentacoes = Movimentacao::query()->where('identificador', $pedido->id)
            ->where('tipo_identificacao', 'PEDIDO')
            ->get();

        return view('prints.cupom', compact('pedido', 'movimentacoes'));
    }
}
