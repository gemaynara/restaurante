<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Services\PedidoService;
use App\Models\Cardapio;
use App\Models\CategoriaCardapio;
use App\Models\EmpresaParametros;
use App\Models\Setor;
use App\Models\SubCategoriaCardapio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class CardapioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cardapios = Cardapio::query()
            ->where('empresa_id', auth()->user()->empresa->id)
            ->get();
        return view('pages.admin.cardapio.cardapio.index', compact('cardapios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setores = Setor::where('empresa_id', auth()->user()->empresa->id)->get();
        $categorias = CategoriaCardapio::where('empresa_id', auth()->user()->empresa->id)->get();
        return view('pages.admin.cardapio.cardapio.create', compact('setores', 'categorias'));
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
            $data = $request->except('_token');
            $data['empresa_id'] = auth()->user()->empresa->id;

            if (!is_null($request->file('imagem'))) {
                $data['imagem'] = Helper::uploadImage($request->file('imagem'), 'cardapios');
            }

//            $data['tempo_preparo'] = '00:'. $data['tempo_preparo'];
            Cardapio::create($data);

            return redirect()->route('cardapios.index')->with('success', 'Item salvo com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar a cardapio: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar o item.');
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
        $cardapio = Cardapio::query()->find($id);
        $setores = Setor::where('empresa_id', auth()->user()->empresa->id)->get();
        $categorias = CategoriaCardapio::where('empresa_id', auth()->user()->empresa->id)->get();
        return view('pages.admin.cardapio.cardapio.edit', compact('cardapio', 'setores', 'categorias'));


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
        try {
            $data = $request->except('_token', '_method');
            $data['empresa_id'] = auth()->user()->empresa->id;
//            $data['tempo_preparo'] = '00:'. $data['tempo_preparo'];
            if (!is_null($request->file('imagem'))) {
                $data['imagem'] = Helper::uploadImage($request->file('imagem'), 'cardapios');
            }

            Cardapio::where('id', $id)->update($data);

            return redirect()->route('cardapios.index')->with('success', 'Item alterado com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao alterar o cardapio: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao alterar o item.');
        }
    }

    public function verCardapio($id)
    {
        $empresa = auth()->user()->empresa->id;
        $categorias = CategoriaCardapio::where('empresa_id', $empresa)->get();

        $cardapio = Cardapio::with('categoriasCardapio')
            ->where('empresa_id', $empresa);

        $produtos = $cardapio->get();

        $pedido = PedidoService::getPedidoMesa($id);

        return view('pages.admin.pedidos.cardapio', compact('categorias', 'produtos', 'pedido'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cardapio::where('id', $id)->delete();
    }

    public function ativar($id)
    {
        Cardapio::where('id', $id)->update(['ativo' => 1]);
    }

    public function desativar($id)
    {
        Cardapio::where('id', $id)->update(['ativo' => 0]);
    }
}
