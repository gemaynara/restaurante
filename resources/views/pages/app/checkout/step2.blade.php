@extends('layouts.app.app')
@section('content')
    <div class="page">
        <div class="navbar navbar-page">
            <div class="navbar-inner sliding">
                <div class="left">
                    <a href="{{route('app.home', $restaurante->slug)}}" class="link back">
                        <i class="ti-arrow-left"></i>
                    </a>
                </div>
                <div class="title">
                   Revisão do Pedido
                </div>
            </div>
        </div>
        <div class="page-content">
            <!-- chef -->
            <div class="chef segments-page">
                <div class="container">

                    <div class="wrap-content">
                        <div class="row">
                            <div class="col-100">
                                    <div class="content-text">
                                        <span>Nome: {{$pedido->nome}}</span>
                                        <br>
                                        <span>Telefone: {{$pedido->telefone}}</span>
                                        <div class="wrap-media">
                                            Endereço para Entrega:
                                            <ul>
                                                <li>{{$pedido->endereco->cep}}</li>
                                                <li>{{$pedido->endereco->endereco}}</li>
                                                <li>{{$pedido->endereco->complemento}}</li>
                                            </ul>
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </div>
                    <div class="wrap-content">
                        <div class="row">
                            <?php $subtotal =0.00 ?>
                            @foreach($pedido->detalhes as $det)
                            <div class="col-100">
                                <div class="content-text">
                                    <h4>{{$det->quantidade}} x {{$det->cardapio->nome}}</h4>
                                    <span>@money($det->valor_subtotal)</span>
                                    <?php $subtotal += $det->valor_subtotal ?>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="wrap-content">
                        <div class="row">
                            <div class="col-60">
                                <div class="content-text">
                                    <span>Subtotal: @money($subtotal)</span>
                                    <span>Taxa de Entrega: @money($restaurante->taxa_entrega)</span>
                                    <h4>Valor Total: @money($subtotal +$restaurante->taxa_entrega)</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-content">
                        <div class="row">
                            <div class="col-40">
                                <div class="content-image">
                                    <img src="images/chef-big5.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-60">
                                <div class="content-text">
                                    <h4>Juwan Powell</h4>
                                    <span>Commis Chef 2</span>
                                    <div class="wrap-media">
                                        <ul>
                                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                                            <li><a href="#"><i class="ti-twitter"></i></a></li>
                                            <li><a href="#"><i class="ti-google"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end chef -->
        </div>
    </div>
@endsection
