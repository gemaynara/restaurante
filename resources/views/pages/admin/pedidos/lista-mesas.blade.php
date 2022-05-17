@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                @include('layouts.partials.alerts')
                <div class="card">
                    <div class="card-body">
                        <div class="container text-center pt-5">
                            <h4 class="mb-3 mt-5">Lista de Mesas</h4>
                            <div class="row pricing-table justify-content-center">
                                @foreach($mesas as $mesa)
                                    <div class="col-md-3 col-xl-3 grid-margin stretch-card pricing-card">
                                        <div class="card border-primary border pricing-card-body">
                                            <div class="text-center pricing-card-head">
                                                <h3>Mesa {{$mesa->codigo}}</h3>
                                                <p>{{$mesa->situacao}}</p>
                                                {{--                                            <h1 class="fw-normal mb-4">$00.00</h1>--}}
                                            </div>
                                            {{--                                        <ul class="list-unstyled plan-features">--}}
                                            {{--                                            <li>Email preview on air</li>--}}
                                            {{--                                            <li>Spam testing and blocking</li>--}}
                                            {{--                                            <li>10 GB Space</li>--}}
                                            {{--                                            <li>50 user accounts</li>--}}
                                            {{--                                            <li>Free support for one years</li>--}}
                                            {{--                                            <li>Free upgrade for one year</li>--}}
                                            {{--                                        </ul>--}}
                                            <div class="wrapper">
                                                @if(!is_null($mesa->numero_pedido))
                                                    <a type="button" href="{{route('ver-cardapio', $mesa->numero_pedido)}}" class="btn btn-warning">Ver Pedido</a>
                                                @else

                                                    <button type="button" class="btn btn-info btn-block"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-mesa-{{$mesa->id}}">Iniciar
                                                    </button>
                                                    @include('pages.admin.pedidos.modal-inicial')
                                                @endif
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
