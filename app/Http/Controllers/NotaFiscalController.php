<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\NotaFiscal;
use App\Models\Produto;
use App\Models\ProdutosNotaFiscal;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotaFiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = NotaFiscal::query()->with('fornecedores')
            ->where('empresa_id', auth()->user()->empresa->id)
            ->get();

        return view('pages.admin.estoque.notas.index', compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fornecedores = Fornecedor::query()
            ->where('empresa_id', auth()->user()->empresa->id)
            ->orderBy('razao_social')
            ->get();

        $produtos = Produto::with('categoriasProduto')
            ->where('empresa_id', auth()->user()->empresa->id)
            ->orderBy('nome')->get();
        return view('pages.admin.estoque.notas.create', compact('fornecedores', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $nota = new NotaFiscal();
            $nota->empresa_id = auth()->user()->empresa->id;
            $nota->fornecedor_id = $request->get('fornecedor_id');
            $nota->usuario_id = auth()->user()->id;
            $nota->numero_nota = $request->get('numero_nota');
            $nota->natureza = $request->get('natureza');
            $nota->valor_frete = $request->get('valor_frete');
            $nota->valor_total = $request->get('total_nota');
//            $nota->valor_desconto = $request->get('desconto');
            $nota->situacao = 'Registrado';
            $nota->save();

            foreach (json_decode($request->produtosNota) as $key => $value) {
                ProdutosNotaFiscal::create([
                    'nota_fiscal_id' => $nota->id,
                    'produto_id' => $value->id_produto,
                    'quantidade' => $value->quantidade,
                    'valor_unitario' => $value->valor_unitario,
                    'subtotal' => $value->valor_unitario * $value->quantidade
                ]);

                Produto::query()->find($value->id_produto)->increment('estoque', $value->quantidade);
            }

            DB::commit();
            return redirect()->route('notas-fiscais.index')->with('success', 'Nota fiscal registrada com sucesso');

        } catch (Exception $e) {
            DB::rollBack();
            Log::info('Ocorreu um erro ao salvar a Nota fiscal : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao registrar a Nota fiscal ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = NotaFiscal::query()->with('fornecedores', 'detalhes')->find($id);

        return view('pages.admin.estoque.notas.show', compact('nota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
