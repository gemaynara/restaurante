<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\EmpresaParametros;
use App\Models\NotaFiscal;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Saida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->empresa->id;
        $today = date('Y-m-d');
        $mes = date('m');

        $empresa = EmpresaParametros::where('empresa_id', $user)
            ->first();

        $itensCardapio = Cardapio::where('empresa_id', $user)->count();

        $produtos = Produto::where('empresa_id', $user)->count();

        $vendas = Pedido::where('empresa_id', $user)
            ->whereIn('status_pedido', ['Comanda Fechada', 'Pedido Finalizado'])
            ->select(DB::raw('SUM(total) as total'))
            ->first();

        $entradas = NotaFiscal::where('empresa_id', $user)
            ->whereMonth('created_at', $mes)
            ->select(DB::raw('SUM(valor_total) as total'))->first();

        $saidas = Saida::where('empresa_id', $user)
            ->whereMonth('created_at', $mes)
//            ->whereDate('created_at', $today)
            ->count();

        $operadores = Pedido::join('users', 'users.id', 'pedidos.operador_id')
            ->select(DB::raw('SUM(total) as valor_total'), 'users.name')
            ->whereMonth('pedidos.created_at', $mes)
            ->groupBy('operador_id')
            ->orderByDesc('valor_total')
            ->get();

        $estoque = Produto::with('categoriasProduto')
            ->where('empresa_id', $user)
            ->orderBy('nome')
            ->get();

        return view('pages.dashboard', [
            'produtos' => $produtos,
            'entradas' => is_null($entradas->total) ? '0.00' : $entradas->total,
            'saidas' => is_null($saidas) ? '0.00' : $saidas,
            'itensCardapio' => $itensCardapio,
            'vendas' => is_null($vendas->total) ? '0.00' : $vendas->total,
            'empresa' => $empresa,
            'operadores' => $operadores,
            'estoque' => $estoque
        ]);

    }
}
