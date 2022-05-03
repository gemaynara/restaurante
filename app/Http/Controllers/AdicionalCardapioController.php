<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdicionalCardapioRequest;
use App\Models\AdicionalCardapio;
use App\Models\SubCategoriaCardapio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class AdicionalCardapioController extends Controller
{
    public function index($id)
    {
        $subcategoria = SubCategoriaCardapio::find($id);
        $adicionais = AdicionalCardapio::with('subCategoriaCardapio')
            ->where('empresa_id', auth()->user()->empresa->id)
            ->where('subcategoria_cardapio_id', $id)
            ->get();


        return view('pages.admin.cardapio.adicionais.index', compact('adicionais', 'subcategoria'));
    }

    public function store(AdicionalCardapioRequest $request)
    {

        try {
            $data = $request->except('_token', '_method');
            $data['empresa_id'] = auth()->user()->empresa->id;

            if (!is_null($request->id)) {
                AdicionalCardapio::where('id', $request->id)
                    ->update($data);
                $msg = 'Adicional alterado com sucesso';
            } else {
                AdicionalCardapio::create($data);
                $msg = 'Adicional salvo com sucesso';
            }


            return redirect()->route('adicionais', ['subcategoria' => $data['subcategoria_cardapio_id']])
                ->with('success', $msg);

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar adicional: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar adicional');
        }
    }

    public function edit($subcategoria, $id)
    {
        $adicional = AdicionalCardapio::find($id);
        $subCategoria = SubCategoriaCardapio::find($subcategoria);
        $adicionais = AdicionalCardapio::with('subCategoriaCardapio')
            ->where('subcategoria_cardapio_id', $subcategoria)
            ->get();
        return view('pages.admin.cardapio.adicionais.index',
            ['adicional' => $adicional, 'subcategoria' => $subCategoria, 'adicionais' => $adicionais]);
    }

    public function destroy($id){
        $adc = AdicionalCardapio::query()->find($id);
        $adc->delete();
    }
}
