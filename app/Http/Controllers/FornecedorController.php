<?php

namespace App\Http\Controllers;

use App\Http\Requests\FornecedorRequest;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fornecedores = Fornecedor::query()
            ->where('empresa_id', auth()->user()->empresa->id)
            ->get();

        return view('pages.admin.cadastros.fornecedores.index', compact('fornecedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.cadastros.fornecedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedorRequest $request)
    {
        try {
            $data = $request->except('_token');

            $data['empresa_id'] = auth()->user()->empresa->id;

            Fornecedor::create($data);

            return redirect()->route('fornecedores.index')->with('success', 'Fornecedor salvo com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao salvar o Fornecedor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar o Fornecedor');
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
        $fornecedor = Fornecedor::find($id);
        return view('pages.admin.cadastros.fornecedores.edit', compact('fornecedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FornecedorRequest $request, $id)
    {
        try {
            $data = $request->except('_token', '_method');

            $data['empresa_id'] = auth()->user()->empresa->id;

            Fornecedor::where('id', $id)->update($data);

            return redirect()->route('fornecedores.index')->with('success', 'Fornecedor alterado com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao alterar o Fornecedor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao alterar o Fornecedor');
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
        Fornecedor::query()->find($id)->delete();
    }
}
