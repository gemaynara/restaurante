@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                @include('layouts.partials.alerts')
                <div class="card">
                    <div class="card-body">
                        <div class="container text-center pt-5">
                            <h4 class="mb-3 mt-5">Painel {{$setor->nome}}</h4>
                            <div class="row pricing-table justify-content-center">
                                @foreach($pedidos as $p)
                                    <div class="col-md-3 col-xl-3 grid-margin stretch-card pricing-card">
                                        <div class="card border-primary border pricing-card-body">
                                            <div class="text-center pricing-card-head">
                                                <h4 class="fw-normal mb-4">Pedido {{$p->tipo_pedido}}</h4>
                                                @if(!is_null($p->mesas))
                                                    <h3>Mesa {{$p->mesas->codigo}}</h3>
                                                @endif
                                                {{--                                                <h1 class="fw-normal mb-4">$00.00</h1>--}}
                                            </div>
                                            <ul class="list-unstyled plan-features">
                                                @foreach($p->detalhes as $item)
                                                    <li>{{$item->quantidade}} x {{$item->cardapio->nome}}</li>
                                                    @foreach($item->adicionais as $adc)
                                                        <small style="float: left!important;font-size: 12px">- {{$adc->quantidade}}x{{$adc->adicionalPedido->nome}}</small>
                                                        <br>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                            <div class="wrapper">
                                                {{--                                                @if(!is_null($mesa->numero_pedido))--}}
                                                {{--                                                    <a type="button" href="{{route('ver-cardapio', $mesa->numero_pedido)}}" class="btn btn-warning">Ver Pedido</a>--}}
                                                {{--                                                @else--}}

                                                {{--                                                    <button type="button" class="btn btn-info btn-block"--}}
                                                {{--                                                            data-bs-toggle="modal"--}}
                                                {{--                                                            data-bs-target="#modal-mesa-{{$mesa->id}}">Iniciar--}}
                                                {{--                                                    </button>--}}
                                                {{--                                                    @include('pages.admin.pedidos.modal-inicial')--}}
                                                {{--                                                @endif--}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
