@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                @include('layouts.partials.alerts')
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Saldo em Caixa</h4>
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">Inicial</p>
                                    <p class="text-muted">@if(!is_null($caixa))
                                            @money($caixa->valor_inicial)
                                        @else R$ 0,00 @endif</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">Saldo Atual</p>
                                    <p class="text-muted">@if(!is_null($caixa))
                                            @money($caixa->valor_inicial+ $caixa->entradas- $caixa->saidas)
                                        @else R$ 0,00 @endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Vendas Realizadas Hoje</h4>
                                <div class="d-flex justify-content-between">
                                    {{--                                    <p class="text-muted">Avg. Session</p>--}}
                                    <p class="text-muted"> @if(!is_null($caixa))@money($caixa->entradas)@else R$
                                        0,00 @endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Retiradas Realizadas Hoje</h4>
                                <div class="d-flex justify-content-between">
                                    {{--                                    <p class="text-muted">Avg. Session</p>--}}
                                    <p class="text-muted"> @if(!is_null($caixa))@money($caixa->saidas)@else R$
                                        0,00 @endif</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Situação</h4>
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">{{isset($caixa->status) && $caixa->status == 'A'? 'Aberto': 'Fechado'}}</p>
                                    <p class="text-muted">
                                        @if(!isset($caixa) || $caixa->status!='A')
                                            <button type="button" class="btn btn-sm btn-success btn-block"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-abrir-caixa">Abrir Caixa
                                            </button>
                                            @include('pages.admin.caixa.abrir-caixa')
                                        @else
                                            <button type="button" class="btn btn-sm btn-warning btn-block"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-fechar-caixa">Fechar Caixa
                                            </button>
                                            @include('pages.admin.caixa.fechar-caixa')
                                        @endif

                                    </p>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Movimentações do Dia</h4>
                        <div class="table-responsive">
                            <table class="table dt">
                                <thead>
                                <tr>
                                    <th class="pt-1 ps-0">
                                        Identificação
                                    </th>
                                    <th class="pt-1 ps-0">
                                        Tipo de Movimentação
                                    </th>
                                    <th class="pt-1 ps-0">
                                       Operador
                                    </th>
                                    <th class="pt-1">
                                        Valor
                                    </th>
                                    <th class="pt-1">
                                        Descrição
                                    </th>
                                    <th class="pt-1">
                                        Data
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($movimentacoes as $mov)
                                        <td class="py-1 ps-0">
{{--                                            <div class="d-flex align-items-center">--}}
                                                <label class="badge badge-success">{{$mov->tipo_identificacao}} </label>

                                                {{--                                                <img src="../../../../images/faces/face1.jpg" alt="profile">--}}

{{--                                            </div>--}}
                                        </td>
                                        <td>
                                            <div class="ms-3">
                                                <label class="badge badge-success">{{$mov->tipo_movimentacao}}</label>
                                                <p class="mb-0 text-muted text-small">{{strtoupper($mov->forma_pagamento)}}</p>
                                                <p class="mb-0 text-muted text-small">{{$mov->tipo_identificacao}}
                                                    #{{$mov->identificador}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            {{$mov->usuarios->name}}
                                        </td>
                                        <td>
                                            @money($mov->valor_pago-$mov->valor_troco)
                                        </td>
                                        <td>
                                            {{$mov->descricao}}
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($mov->created_at)->format('d/m/Y H:i:s')}}
                                        </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
