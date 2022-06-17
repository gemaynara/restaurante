<?php

namespace App\Http\Controllers;

use App\Models\ControleCaixa;
use App\Models\Movimentacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
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
            ->take(10)
//            ->whereDate('created_at', date('Y-m-d'))
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

    public function getResumoCaixa()
    {
        return view('pages.admin.caixa.resumo-caixa');
    }

    public function resumoCaixaPdf(Request $request)
    {
        $data = $request->data;

//        if (strtotime($final) < strtotime($inicial)) {
//            return back()->with('warning', 'Período inválido. Tente novamente');
//        }

        $caixa = ControleCaixa::query()
            ->whereDate('updated_at', '<=',$data)
            ->where('empresa_id', auth()->user()->empresa->id)
            ->orderBy('id', 'desc')
            ->first();

        $movimentacoes = Movimentacao::query()
            ->whereDate('created_at', '<=',$data)
            ->where('empresa_id', auth()->user()->empresa->id)
            ->where('tipo_movimentacao', 'ENTRADA')
            ->select(DB::raw('SUM(valor_pago-valor_troco) as valor_pago'), 'forma_pagamento')
            ->groupBy('forma_pagamento')
            ->orderBy('forma_pagamento')
            ->get();


        $pdf = PDF::loadView('reports.pdf.resumo-caixa', compact('caixa', 'data', 'movimentacoes'))
            ->setPaper('a4', 'portrait');

//        return $pdf->stream('invoice.pdf');
        return $pdf->download("resumo-caixa-".Carbon::parse($data)->format('d-m-Y').".pdf");


    }
}
