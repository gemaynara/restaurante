<?php

namespace App\Http\Controllers;

use App\Http\Services\ControleCaixaService;
use App\Models\Mesa;
use App\Models\Movimentacao;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class MovimentacaoController extends Controller
{
    public function pagarPedido($id)
    {

        $pedido = Pedido::with('detalhes', 'mesas', 'endereco')
            ->find($id);

        $existeCaixa = ControleCaixaService::getCaixa();

        $movimentacoes = Movimentacao::query()->where('identificador', (int)$id)
            ->where('tipo_identificacao', 'PEDIDO')
            ->get();

        return view('pages.admin.movimentacao.pedido', compact('pedido', 'movimentacoes', 'existeCaixa'));

    }

    public function pagamentoPedido(Request $request)
    {

        try {
            DB::beginTransaction();
            $data = $request->except('_token', '_method');

            $data['tipo_movimentacao'] = 'ENTRADA';
            $data['descricao'] = 'Pagamento Comanda n.' . $request->pedido;
            $data['valor_troco'] = 0.00;
            $data['empresa_id'] = auth()->user()->empresa->id;
            $data['usuario_id'] = auth()->user()->id;

            $pedido = Pedido::query()->where('id', $data['identificador'])
                ->where('empresa_id', auth()->user()->empresa->id)
                ->first();

            $totalPago = $request->valor_pago + $request->saldo_pago;
            $troco = 0.00;

            if ($totalPago >= $request->valor_total) {
                $troco = ($totalPago - $request->valor_total);
                $data['valor_troco'] = $troco;

                $pedido->update(['status_pedido' => 'Pedido Finalizado']);
                Mesa::query()->where('empresa_id', auth()->user()->empresa->id)
                    ->where('id', $pedido->mesa_id)
                    ->update(['situacao' => 'Livre']);
            }
            Movimentacao::create($data);

            $entrada = $totalPago - $troco;
            $caixa = ControleCaixaService::getCaixa();
            $caixa->update(['entradas' => DB::raw('entradas+' . $entrada)]);
            DB::commit();

            return redirect()->back()->with('success', "Pagamento Realizado com Sucesso!");
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao realizar pagamento.');
        }
    }

    public function saidaCaixa(Request $request)
    {

        try {
            DB::beginTransaction();
            $data = $request->except('_token', '_method');

            $data['tipo_movimentacao'] = 'SAIDA';
            $data['empresa_id'] = auth()->user()->empresa->id;
            $data['usuario_id'] = auth()->user()->id;
            $data['valor_total'] = $request->valor_pago;

            $caixa = ControleCaixaService::getCaixa();

            if ($request->valor_pago > $caixa->valor_inicial + $caixa->entradas - $caixa->saidas) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Saldo do caixa insuficiente para retirada.');
            }

            Movimentacao::create($data);
            $caixa->update(['saidas' => DB::raw('saidas+' . $request->valor_pago)]);
            DB::commit();

            return redirect()->back()->with('success', "Retirada registrada com Sucesso!");
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao registrar retirada.');
        }
    }

    public function retiradasCaixa()
    {
        $movimentacoes = Movimentacao::query()
            ->with('usuarios')
            ->where('empresa_id', auth()->user()->empresa->id)
            ->where('tipo_movimentacao', 'SAIDA')
            ->get();

        return view('pages.admin.movimentacao.retiradas', compact('movimentacoes'));
    }
}
