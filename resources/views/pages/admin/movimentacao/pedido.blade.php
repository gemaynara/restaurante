@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            @include('layouts.partials.alerts')
            <div class="col-md-8">
                <div class="card px-2">
                    <div class="card-body">
                        <div class="container-fluid">
                            <h3 class="text-right my-5">Pedido #{{$pedido->numero_pedido}}</h3>
                            <h3 class="text-right my-5">
                                Mesa {{!is_null($pedido->mesas) ? $pedido->mesas->codigo: '-'}}</h3>
                            <hr>
                        </div>
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 ps-0">
                                <p class="mt-6 mb-2"><b>Situação Pedido:</b> {{$pedido->status_pedido}}</p>
                                {{--                                <p>104,<br>Minare SK,<br>Canada, K1A 0G9.</p>--}}
                            </div>
                            <div class="col-lg-6 pr-0">
                                {{--                                                                <p class="mt-5 mb-2 text-right"><b>Invoice to</b></p>--}}
                                <p class="text-right">Data
                                    Pedido: {{\Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i:s')}}</p>
                                <p class="text-right">Data Ult.
                                    Alteração: {{\Carbon\Carbon::parse($pedido->updated_at)->format('d/m/Y H:i:s')}}</p>
                            </div>
                        </div>
                        <div class="container-fluid d-flex justify-content-between">
                            {{--                                                    <div class="col-lg-3 ps-0">--}}
                            {{--                                                        <p class="mb-0 mt-5">Data: {{\Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i:s')}}</p>--}}
                            {{--                                                        <p>Due Date : 25th Jan 2017</p>--}}
                            {{--                                                    </div>--}}
                        </div>
                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table table-sm">
                                    <thead>
                                    <tr class="bg-dark text-white">
                                        <th>Descrição</th>
                                        <th>Qnt.</th>
                                        <th>Vl. Unitário</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pedido->detalhes as $det)
                                        <tr class="text-right">
                                            <td class="text-left">{{$det->cardapio->nome}}<br>
                                                @foreach($det->adicionais as $adc)
                                                    <span class="mb-0 text-muted text-small">- {{$adc->adicionalPedido->nome}} - @money($adc->subtotal)</span>
                                                    <br>
                                                @endforeach
                                                <span class="mb-0 text-muted text-small">@if(!empty($det->observacoes))
                                                        Obs.{{$det->observacoes}}@endif</span>

                                            </td>
                                            <td>{{$det->quantidade}}</td>
                                            <td>@money($det->valor_unitario)</td>
                                            <td>@money($det->valor_subtotal)</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="container-fluid mt-5 w-100">
                            <p class="text-right mb-2">Subtotal: @money($pedido->subtotal+$pedido->adicionais)</p>
                            <p class="text-right">Taxa ({{(int)app('restaurante')['parametros']['gorjeta']}}%) :
                                @money($pedido->taxa)</p>
                            <h4 class="text-right mb-5">Total : @money($pedido->total)</h4>
                            <hr>

                            <p class="text-right mb-2">Número de Pessoas:{{$pedido->numero_pessoas}}</p>
                            <p class="text-right">Valor por Pessoa: @money($pedido->total/$pedido->numero_pessoas)</p>
                            <hr>
                        </div>
                        <div class="container-fluid w-100">
                            <a href="{{route('pedidos.encerrados')}}" class="btn btn-success float-right mt-4"><i
                                    class="ti-arrow-circle-left me-1"></i>Voltar</a>
                            <a href="{{route('pedidos.cupom', ['id'=>$pedido->numero_pedido])}}" target="_blank"
                               class="btn btn-primary float-right mt-4 ms-2"><i class="ti-printer me-1"></i>Imprimir
                                Cupom</a>


{{--                            <a href="#" class="btn btn-warning float-right mt-4"><i class="ti-money me-1"></i>Ir para Pagamento</a>--}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card px-2">
                    <div class="card-body">
                        <div class="container-fluid">
                            <h3 class="text-right my-5">Histórico de Pagamento</h3>
                            <hr>
                        </div>
                        <div class="card-body">
                            <ul class="bullet-line-list">
                                <?php $saldo_pago = 0.00 ?>
                                @foreach($movimentacoes as $mov)
                                    <li>
                                        <h6>@money($mov->valor_pago)
                                            <label
                                                class="badge badge-success float-right pl-3">{{$mov->forma_pagamento}}</label>

                                        </h6>
                                        <p class="text-muted mb-4">
                                            <i class="ti-time"></i>
                                            {{$mov->created_at->diffForHumans(now())}}
                                        </p>
                                    </li>
                                    <?php $saldo_pago += $mov->valor_pago ?>
                                @endforeach
                            </ul>
                        </div>

                        <div class="container-fluid mt-3 w-100">
                            <p class="text-right mb-2">Subtotal: @money($pedido->subtotal+$pedido->adicionais)</p>
                            <p class="text-right">Taxa ({{(int)app('restaurante')['parametros']['gorjeta']}}%) :
                                @money($pedido->taxa)</p>
                            <h4 class="text-right mb-5">Total : @money($pedido->total)</h4>
                            <hr>
                            @if($pedido->status_pedido == 'Pedido Finalizado')
                                <h4 class="text-right text-success font-weight-bold">Total Pago:
                                    @money($saldo_pago)</h4>
                                <h4 class="text-right text-success font-weight-bold">Troco:
                                    @money($saldo_pago-$pedido->total)</h4>
                            @else
                                <h4 class="text-right text-danger font-weight-bold mb-5">Saldo:
                                    @money($pedido->total-$saldo_pago)</h4>
                            @endif
                        </div>
                        <div class="container-fluid w-100">
                            <a href="{{route('pedidos.comanda', ['id'=>$pedido->numero_pedido])}}" target="_blank"
                               class="btn btn-primary float-right mt-4 ms-2"><i class="ti-printer me-1"></i>Imprimir
                                Comanda</a>


                            <button type="button" class="btn btn-success float-right mt-4"
                                    data-bs-toggle="modal" {{!$existeCaixa ? 'disabled': ''}}
                                    data-bs-target="#modal-pagamento"><i class="ti-money me-1"></i>Realizar
                                Pagamento
                            </button>
                            @include('pages.admin.movimentacao.modal-pagamento')

                            <div class="mt-1" @if($existeCaixa) style="display: none" @endif>
                                <div class="alert alert-danger" role="alert">
                                    Não é possível realizar movimentações com o caixa fechado.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
