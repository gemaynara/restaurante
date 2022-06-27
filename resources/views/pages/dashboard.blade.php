@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-3 grid-margin">
                <div class="card d-flex align-items-start">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-start">
                            <i class="ti-view-list text-facebook icon-md"></i>
                            <div class="ms-3">
                                <h6 class="text-facebook itens-cardapio">{{$itensCardapio}}</h6>
                                <p class="mt-2 text-muted card-text">Itens Cadastrados no Cardápio</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin">
                <div class="card d-flex align-items-start">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-start">
                            <i class="ti-bookmark text-youtube icon-md"></i>
                            <div class="ms-3">
                                <h6 class="text-youtube entradas">@money($entradas)</h6>
                                <p class="mt-2 text-muted card-text">Notas Fiscais Registradas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin">
                <div class="card d-flex align-items-start">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-start">
                            <i class="ti-money text-twitter icon-md"></i>
                            <div class="ms-3">
                                <h6 class="text-twitter vendas">@money($vendas)</h6>
                                <p class="mt-2 text-muted card-text">Vendas Realizadas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex flex-row flex-wrap text-start align-items-center">
                            <img src="../../../../images/faces/face9.jpg" class="img-lg rounded" alt="profile image">
                            <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                <h6 class="mb-0">Cardápio Digital</h6>
                                <p class="text-muted mb-1">thomas@gmail.com</p>
                                <p class="mb-0 text-success fw-bold">Developer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 grid-margin grid-margin-md-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Situação do Estoque</h4>
                        <div class="table-responsive">
                            <table class="table dt">
                                <thead>
                                <tr>
                                    <th class="pt-1 ps-0">
                                        Produto
                                    </th>
                                    <th class="pt-1">
                                        Estoq. Atual
                                    </th>
                                    <th class="pt-1">
                                        Estoq. Min.
                                    </th>
                                    <th class="pt-1">
                                        Estoq. Máx.
                                    </th>
                                    <th class="pt-1">
                                        Situação
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($estoque as $est)
                                    <tr>
                                        <td class="py-1 ps-0">
                                            <div class="d-flex align-items-center">
                                                {{--                                                <img src="../../../../images/faces/face1.jpg" alt="profile">--}}
                                                <div class="ms-3">
                                                    <p class="mb-0">{{$est->nome}}</p>
                                                    <p class="mb-0 text-muted text-small">{{$est->categoriasProduto->nome}}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td>{{$est->estoque}}</td>
                                        <td>{{$est->estoque_min}}</td>
                                        <td>{{$est->estoque_max}}</td>
                                        <td>
                                            @if($est->estoque > $est->estoque_min)
                                                <label class="badge badge-warning">Estoque Moderado</label>
                                            @elseif($est->estoque > $est->estoque_max)
                                                <label class="badge badge-danger">Estoque Confortável</label>
                                            @elseif($est->estoque < $est->estoque_min)
                                                <label class="badge badge-danger">Estoque Baixo</label>
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 grid-margin grid-margin-md-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="card-title card-title-dash">Operadores</h4>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    @foreach($operadores as $op)
                                        <div
                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                            <div class="d-flex">
                                                <img class="img-sm rounded-10" src="{{asset('images/no-picture.jpg')}}"
                                                     alt="profile">
                                                <div class="wrapper ms-3">
                                                    <p class="ms-1 mb-1 fw-bold">{{$op->name}}</p>
                                                    <small class="text-muted mb-0">@money($op->valor_total)</small>
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

    </div>
@endsection
@push('scripts')
    <script>
        $('.qr_code').on('click', function (e) {
            e.preventDefault();
            var remote = $(this).data('url');
            var url = `https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=${remote}`;
            window.open(url)
        })
    </script>


    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            var url = '{{env('URL_JS')}}';--}}
    {{--            // var url = window.location.origin + '/brasazd';--}}
    {{--            $.ajax({--}}
    {{--                url: url + "/dashboard",--}}
    {{--                cache: false,--}}
    {{--                success: function (data) {--}}
    {{--                    console.log(data)--}}
    {{--                    $(".itens-cardapio").html(data.itensCardapio);--}}
    {{--                    $(".produtos").html(data.produtos);--}}
    {{--                    $(".entradas").html(data.entradas);--}}
    {{--                    $(".saidas").html(data.saidas);--}}
    {{--                    $(".vendas").html(data.vendas);--}}
    {{--                    var empresa = data.empresa.slug--}}
    {{--                    var rota = url + '/app/' + empresa + '/principal'--}}
    {{--                    $(".link-app").html('<a target="_blank" href="' + rota + '">clique aqui</a>');--}}
    {{--                }--}}
    {{--            });--}}
    {{--        })--}}


    {{--    </script>--}}
@endpush

