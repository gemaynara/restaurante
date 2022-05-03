<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoriaCardapioRequest;
use App\Http\Requests\SubCategoriaRequest;
use App\Models\CategoriaCardapio;
use App\Models\SubCategoriaCardapio;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class SubCategoriaCardapioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategorias = SubCategoriaCardapio::with('categoriaCardapio')
            ->where('empresa_id', auth()->user()->empresa->id)->get();

        return view('pages.admin.cardapio.subcategorias.index', compact('subcategorias'));
    }


    public function listaSubCategoriasCardapio($id)
    {
        $subcategorias = SubCategoriaCardapio::query()
            ->where('empresa_id', auth()->user()->empresa->id)
            ->where('categoria_cardapio_id', $id)
            ->orderBy('nome', 'asc')->get();

        return response()->json($subcategorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = CategoriaCardapio::where('empresa_id', auth()->user()->empresa->id)->get();
        return view('pages.admin.cardapio.subcategorias.create', compact('categorias'));
    }


    public function store(SubCategoriaCardapioRequest $request)
    {
        try {
            $data = $request->except('_token');
            $data['empresa_id'] = auth()->user()->empresa->id;

            SubCategoriaCardapio::create($data);

            return redirect()->route('sub-categorias-cardapio.index')->with('success', 'Sub Categoria salva com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar a sub categoria: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar a sub categoria');
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
        $subcategoria = SubCategoriaCardapio::find($id);
        $categorias = CategoriaCardapio::query()->where('empresa_id', auth()->user()->empresa->id)->get();
        return view('pages.admin.cardapio.subcategorias.edit', compact('subcategoria', 'categorias'));
    }


    public function update(SubCategoriaCardapioRequest $request, $id)
    {
        try {
            $data = $request->except('_token', '_method');
            $data['empresa_id'] = auth()->user()->empresa->id;

            SubCategoriaCardapio::where('id', $id)->update($data);

            return redirect()->route('sub-categorias-cardapio.index')->with('success', 'Sub Categoria alterada com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao alterar a sub categoria: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao alterar a sub categoria');
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
        $subcategoria = SubCategoriaCardapio::query()->find($id);
        $subcategoria->delete();
    }
}
