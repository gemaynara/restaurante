<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\CategoriaProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::with('categoriasProduto')
        ->where('empresa_id', auth()->user()->empresa->id)
            ->orderBy('nome')->get();

        return view('pages.admin.estoque.produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medidas = Produto::medidas();
        $categorias = CategoriaProduto::query()
            ->where('empresa_id', auth()->user()->empresa->id)
            ->get();
        return view('pages.admin.estoque.produtos.create', compact('medidas','categorias'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        try {
            $data = $request->except('_token');

            $data['empresa_id'] = auth()->user()->empresa->id;

            Produto::create($data);

            return redirect()->route('produtos.index')->with('success', 'Produto salvo com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar o produto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar o produto');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::with('categoriasProduto')->find($id);
        $medidas = Produto::medidas();
        $categorias = CategoriaProduto::query()
            ->where('empresa_id', auth()->user()->empresa->id)
            ->get();

        return view('pages.admin.estoque.produtos.edit', compact('categorias', 'produto', 'medidas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        try {
            $data = $request->except('_token', '_method');

            $data['empresa_id'] = auth()->user()->empresa->id;

            Produto::where('id', $id)->update($data);

            return redirect()->route('produtos.index')->with('success', 'Produto alterado com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao alterar o produto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao alterar  o produto');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produto::query()->find($id)->delete();
    }
}
