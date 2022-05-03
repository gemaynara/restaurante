<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\CategoriaCardapioRequest;
use App\Models\CategoriaCardapio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class CategoriaCardapioController extends Controller
{

    public function index()
    {
        $categorias = CategoriaCardapio::query()
            ->where('empresa_id', auth()->user()->empresa->id)
            ->get();

        return view('pages.admin.cardapio.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('pages.admin.cardapio.categorias.create');
    }


    public function store(CategoriaCardapioRequest $request)
    {
        try {
            $data = $request->except('_token');

            if (!is_null($request->file('icone'))) {
                $data['icone'] = Helper::uploadImage($request->file('icone'), 'categorias');
            }
            $data['empresa_id'] = auth()->user()->empresa->id;

            CategoriaCardapio::create($data);

            return redirect()->route('categorias-cardapio.index')->with('success', 'Categoria salva com sucesso');

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
        $categoria = CategoriaCardapio::query()->find($id);
        return view('pages.admin.cardapio.categorias.edit', compact('categoria'));
    }


    public function update(CategoriaCardapioRequest $request, $id)
    {
        try {
            $data = $request->except('_token', '_method');

            if (!is_null($request->file('icone'))) {
                $data['icone'] = Helper::uploadImage($request->file('icone'), 'categorias');
            }
            $data['empresa_id'] = auth()->user()->empresa->id;

            CategoriaCardapio::where('id', $id)->update($data);

            return redirect()->route('categorias-cardapio.index')->with('success', 'Categoria alterada com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar a categoria: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao alterar a categoria');
        }
    }


    public function destroy($id)
    {
        $categoria = CategoriaCardapio::query()->find($id);
        $categoria->delete();
    }
}
