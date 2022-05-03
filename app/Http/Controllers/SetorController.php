<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetorRequest;
use App\Models\Setor;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class SetorController extends Controller
{

    public function index()
    {
        $setores = Setor::query()
            ->where('empresa_id', auth()->user()->empresa->id)->get();

        return view('pages.admin.cadastros.setores.index', compact('setores'));
    }


    public function create()
    {
        return view('pages.admin.cadastros.setores.create');
    }


    public function store(SetorRequest $request)
    {
        try {
            $data = $request->except('_token');

            $data['empresa_id'] = auth()->user()->empresa->id;

            Setor::create($data);

            return redirect()->route('setores.index')->with('success', 'Setor salvo com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar o setor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar o setor');
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
        $setor = Setor::query()->find($id);
        return view('pages.admin.cadastros.setores.edit', compact('setor'));
    }


    public function update(SetorRequest $request, $id)
    {
        try {
            $data = $request->except('_token', '_method');

            $data['empresa_id'] = auth()->user()->empresa->id;

            Setor::where('id', $id)->update($data);

            return redirect()->route('setores.index')->with('success', 'Setor alterado com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao alterar o setor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao alterar o setor');
        }
    }


    public function destroy($id)
    {
        $setor = Setor::query()->find($id);
        $setor->delete();
    }
}
