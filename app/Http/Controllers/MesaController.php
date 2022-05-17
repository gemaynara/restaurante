<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::query()
            ->where('empresa_id', auth()->user()->empresa->id)->get();

        return view('pages.admin.cadastros.mesas.index', compact('mesas'));
    }


    public function create()
    {
        return view('pages.admin.cadastros.mesas.create');
    }


    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');

            $ifExists = Mesa::query()->where('codigo', (int)$data['codigo'])
                ->where('empresa_id', auth()->user()->empresa->id)
                ->first();

            if ($ifExists) {
                return redirect()->back()->with('warning', 'Código da mesa já cadastrado.');
            } else {
                $data['empresa_id'] = auth()->user()->empresa->id;

                Mesa::create($data);

                return redirect()->route('mesas.index')->with('success', 'Mesa salva com sucesso');
            }
        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar a mesa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar a mesa');
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


    public function destroy($id)
    {
        $mesa = Mesa::query()->find($id);
        $mesa->delete();
    }
}
