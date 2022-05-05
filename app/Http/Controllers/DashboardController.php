<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\NotaFiscal;
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
        $itensCardapio = Cardapio::where('empresa_id', $user)->count();
        $produtos = Produto::where('empresa_id', $user)->count();
        $entradas = NotaFiscal::where('empresa_id', $user)
            ->select(DB::raw('SUM(valor_total) as total'))->first();

        $saidas = Saida::where('empresa_id', $user)
            ->whereDate('created_at', $today)
            ->count();

        return [
            'produtos' => $produtos,
            'entradas' => is_null($entradas->total)? '0.00': $entradas->total,
            'saidas' => is_null($saidas)? '0.00': $saidas,
            'itensCardapio' => $itensCardapio,
        ];

    }
}
