<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutosSaida;
use App\Models\Saida;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaidaController extends Controller
{
    public function index()
    {
        $saidas = Saida::query()
            ->with('usuarios')
            ->where('empresa_id', auth()->user()->empresa->id)
            ->get();


        return view('pages.admin.estoque.saidas.index', compact('saidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $produtos = Produto::with('categoriasProduto')
            ->where('empresa_id', auth()->user()->empresa->id)
            ->where('estoque', '>', 0)
            ->orderBy('nome')->get();

        return view('pages.admin.estoque.saidas.create', compact('produtos'));
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $saida = new Saida();
            $saida->empresa_id = auth()->user()->empresa->id;
            $saida->usuario_id = auth()->user()->id;
            $saida->observacoes = $request->get('descricao');
            $saida->situacao = 'Registrado';
            $saida->save();

            foreach (json_decode($request->produtos) as $key => $value) {
                $produto = Produto::find($value->id_produto);
                ProdutosSaida::create([
                    'saida_id' => $saida->id,
                    'produto_id' => $value->id_produto,
                    'quantidade' => $value->quantidade,
                    'valor_unitario' => $produto->valor,
                    'subtotal' => $value->quantidade * $produto->valor
                ]);

                $produto->decrement('estoque', $value->quantidade);
            }

            DB::commit();
            return redirect()->route('saidas.index')->with('success', 'Saída registrada com sucesso');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info('Ocorreu um erro ao salvar a saidal : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao registrar a saida ');
        }
    }

    public function show($id)
    {
        $saida = Saida::query()->with('usuarios', 'detalhes')->find($id);

        return view('pages.admin.estoque.saidas.show', compact('saida'));
    }

}
