<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaProdutoRequest;
use App\Models\CategoriaProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class CategoriaProdutoController extends Controller
{
    public function index()
    {
        $categorias = CategoriaProduto::query()
            ->where('empresa_id', auth()->user()->empresa->id)
            ->get();

        return view('pages.admin.estoque.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('pages.admin.estoque.categorias.create');
    }


    public function store(CategoriaProdutoRequest $request)
    {
        try {
            $data = $request->except('_token');

            $data['empresa_id'] = auth()->user()->empresa->id;

            CategoriaProduto::create($data);

            return redirect()->route('categorias-produto.index')->with('success', 'Categoria salva com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar a categoria: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar a categoria');
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


    public function edit($id)
    {
        $categoria = CategoriaProduto::query()->find($id);
        return view('pages.admin.estoque.categorias.edit', compact('categoria'));
    }


    public function update(CategoriaProdutoRequest $request, $id)
    {
        try {
            $data = $request->except('_token', '_method');


            $data['empresa_id'] = auth()->user()->empresa->id;

            CategoriaProduto::where('id', $id)->update($data);

            return redirect()->route('categorias-produto.index')->with('success', 'Categoria alterada com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar a categoria: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao alterar a categoria');
        }
    }


    public function destroy($id)
    {
        $categoria = CategoriaProduto::query()->find($id);
        $categoria->delete();
    }
}
