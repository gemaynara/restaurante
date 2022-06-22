@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
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
                                <table class="table">
                                    <thead>
                                    <tr class="bg-dark text-white">
                                        <th>Descrição</th>
                                        <th>Qnt.</th>
                                        <th>Vl. Unitário</th>
                                        <th>Total</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($pedido->detalhes) == 0)
                                        <tr>
                                            <td>
                                                Sem itens
                                            </td>
                                        </tr>
                                    @else
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
                                                <td>
                                                    <button type="button"
                                                            data-remote="{{route('pedidos.remove-item', $det->id)}}"
                                                            data-id="{{$det->id}}"
                                                            {{$pedido->status_pedido == 'Pedido Finalizado' || $pedido->status_pedido == 'Pedido Cancelado' ? 'disabled': ''}}
                                                            class="btn btn-outline-secondary btn-rounded btn-icon btn-sm remove-item">
                                                        <i class="icon-close text-danger"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
                            <a href="{{\Illuminate\Support\Facades\URL::previous()}}" class="btn btn-success float-right mt-4"><i
                                    class="ti-arrow-circle-left me-1"></i>Voltar</a>

                            <a href="{{route('pedidos.cancelar-comanda')}}" data-id="{{$pedido->id}}"
                               class="btn btn-danger float-right mt-4 cancel-comanda
 {{$pedido->status_pedido == 'Pedido Cancelado' || $pedido->status_pedido == 'Pedido Finalizado' ? 'disabled': ''}}"
                            ><i
                                    class="ti-close me-1"></i>Cancelar Comanda</a>

                            <a href="{{route('pedidos.cupom', ['id'=>$pedido->numero_pedido])}}" target="_blank"
                               class="btn btn-primary float-right mt-4 ms-2"><i class="ti-printer me-1"></i>Imprimir
                                Cupom</a>


                            <a href="{{route('movimentacao.pagar-pedido', $pedido->id)}}"
                               class="btn btn-warning float-right mt-4" {{$pedido->status_pedido == 'Pedido Cancelado' ? 'disabled': ''}}
                            ><i class="ti-money me-1"></i>Ir para
                                Pagamento</a>

                            {{--                            <form action="{{route('pedidos.cancelar-comanda')}}" method="post" class="">--}}
                            {{--                                @csrf--}}
                            {{--                                <input type="hidden" name="numero_pedido" value="{{$pedido->numero_pedido}}">--}}
                            {{--                                <button type="submit" class="btn btn-danger float-right mt-4"><i--}}
                            {{--                                        class="ti-close me-1"></i> Cancelar Comanda</button>--}}
                            {{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
