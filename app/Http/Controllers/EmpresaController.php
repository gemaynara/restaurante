<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\Empresa;
use App\Models\EmpresaParametros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::query()
            ->whereNotIn('razao_social', ['Painel Admin'])
            ->orderBy('razao_social')
            ->get();

        return view('pages.super-admin.empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.super-admin.empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)
    {
        try {
            $data = $request->except('_token');

            $empresa = Empresa::create($data);
            EmpresaParametros::query()->create([
                'empresa_id' => $empresa->id,
                'logo' => 'no-image.png',
                'slug' => Str::slug($data['razao_social'])
            ]);


            return redirect()->route('empresas.index')->with('success', 'Empresa salva com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar a empresa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar a empresa');
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
        $empresa = Empresa::find($id);
        return view('pages.super-admin.empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaRequest $request, $id)
    {
        try {
            $data = $request->except('_token', '_method');

            $empresa = Empresa::where('id', $id)->update($data);

            return redirect()->route('empresas.index')->with('success', 'Empresa alterada com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao alterar a empresa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao alterar a empresa');
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
        User::query()->where('empresa_id', $id)->delete();
        EmpresaParametros::query()->where('empresa_id', $id)->delete();
        Empresa::query()->find($id)->delete();

    }

    public function ativar($id)
    {
        $empresa = Empresa::where('id', $id)
            ->update(['ativo' => 1]);

        User::query()->where('empresa_id', $id)->update(['active' => 1]);
    }

    public function desativar($id)
    {
        $empresa = Empresa::where('id', $id)
            ->update(['ativo' => 0]);

        User::query()->where('empresa_id', $id)->update(['active' => 0]);
    }
}
