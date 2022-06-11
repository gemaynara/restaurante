<?php

namespace App\Http\Controllers;

use App\Models\ControleCaixa;
use App\Models\Movimentacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ControleCaixaController extends Controller
{

    public function index()
    {
        $caixa = ControleCaixa::query()->where('empresa_id', auth()->user()->empresa->id)
            ->where('status', 'A')
            ->orderBy('id', 'desc')
            ->first();

        $movimentacoes = Movimentacao::query()
            ->with('usuarios')
            ->where('empresa_id', auth()->user()->empresa->id)
            ->orderBy('id', 'desc')
            ->whereDate('created_at', date('Y-m-d'))
            ->get();

        return view('pages.admin.caixa.index', compact('caixa', 'movimentacoes'));
    }

    public function abrirCaixa(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token', '_method');
            $data['empresa_id'] = auth()->user()->empresa->id;

            $existeCaixa = ControleCaixa::query()
                ->whereDate("updated_at", '>=', date('Y-m-d'))
                ->where('empresa_id', $data['empresa_id'])
                ->where('status', 'F')
                ->orderBy('id', 'desc')
                ->first();

            if (!empty($existeCaixa)) {
                $existeCaixa->update(['status' => 'A']);
                $msg = 'Já existe um registro de caixa iniciado hoje';
            } else {
                $data['empresa_id'] = auth()->user()->empresa_id;
                ControleCaixa::create($data);
                $msg = 'Caixa aberto com sucesso';
            }

            DB::commit();

            return redirect()->route('caixa.index')->with('success', $msg);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect()->route('caixa.index')->with('error', 'Ocorreu um erro ao abrir o caixa.');
        }
    }

    public function fecharCaixa(Request $request)
    {

        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            ControleCaixa::where('id', $data['id'])
                ->where('empresa_id', auth()->user()->empresa->id)
                ->update([
                    'valor_final' => $data['valor_final'],
                    'saldo_quebra' => $data['saldo_quebra'],
                    'saldo_falta' => $data['saldo_falta'],
                    'observacoes' => $data['observacoes'],
                    'status' => 'F'
                ]);

            DB::commit();

            return redirect()->route('caixa.index')->with('success', 'Caixa fechado com sucesso');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect()->route('caixa.index')->with('error', 'Ocorreu um erro ao fechar o caixa.');
        }
    }
}
