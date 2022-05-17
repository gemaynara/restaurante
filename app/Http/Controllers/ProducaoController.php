<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Setor;
use Illuminate\Http\Request;

class ProducaoController extends Controller
{
    public function producao($setor)
    {
        $setor = Setor::query()->where('nome', $setor)
            ->where('empresa_id', auth()->user()->empresa->id)
            ->first();

        $pedidos = Pedido::with(['mesas', "detalhes"])
            ->orderBy('id', 'desc')
            ->whereIn('status_pedido', ['Pedido Efetuado', 'Em Produção'])
            ->get();

        return view('pages.admin.producao.em-producao', compact('pedidos', 'setor'));

    }
}
