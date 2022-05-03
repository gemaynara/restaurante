<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Cardapio;
use App\Models\Empresa;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function cardapio(Empresa $empresa)
    {

        $cardapio = Cardapio::query()
            ->with('categoriasCardapio')
            ->where('empresa_id', $empresa->id)
            ->where('ativo', 1)
            ->get();

        return response()->json($cardapio);
    }
}
