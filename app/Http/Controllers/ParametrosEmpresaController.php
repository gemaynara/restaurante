<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Empresa;
use App\Models\EmpresaParametros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ParametrosEmpresaController extends Controller
{
    public function index()
    {
        $empresa = Empresa::query()->with('parametros')
            ->find(auth()->user()->empresa->id);

        return view('pages.admin.parametros.index', compact('empresa'));
    }

    public function update(Request $request, $id)
    {

        try {
            $data = $request->except('_token', '_method');

            if (!is_null($request->file('logo'))) {
                $data['logo'] = Helper::uploadImage($request->file('logo'), 'empresas');
                EmpresaParametros::where('empresa_id', $id)->update(['logo' => $data['logo']]);
            }
            Empresa::where('id', $id)->update([
                'razao_social' => $data['razao_social'],
                'cnpj' => $data['cnpj'],
                'email' => $data['email'],
                'endereco' => $data['endereco'],
                'bairro' => $data['bairro'],
                'cep' => $data['cep'],
                'telefone' => $data['telefone'],
                'cidade' => $data['cidade'],
                'estado' => $data['estado'],
            ]);

            EmpresaParametros::where('empresa_id', $id)
                ->update([
                    'gorjeta' => $data['gorjeta'],
                    'taxa_entrega' => $data['taxa_entrega'],
                ]);

            return redirect()->route('parametros.index')->with('success', 'Ajustes alterados com sucesso');

        } catch (Exception $e) {
            Log::info('Ocorreu um erro ao alterar os parametros: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao alterar.');
        }
    }
}
