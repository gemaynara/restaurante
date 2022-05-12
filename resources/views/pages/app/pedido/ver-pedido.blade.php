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
            </div>
        </div>
        <div class="page-content">
            <!-- restaurant single -->
            <div class="restaurant-single segments-page">
                <div class="container">
                    {{--                    <div class="header">--}}
                    {{--                        <img src="images/restaurant2.jpg" alt="">--}}
                    {{--                    </div>--}}
                    <div class="desc">
                        <h4>ABCD Restaurant</h4>
                        <span><i class="ti-location-pin"></i>Los Angeles 09, California</span>
                        <p>Open 08.00 AM</p>
                    </div>
                    <div class="resto-menu">
                        <div class="wrap-title">
                            <h3>Carrinho</h3>
                        </div>
                        @if(isset($pedido) && count($pedido) > 0)
                            <div class="row">
                                @foreach($pedido as $p)
                                    <div class="col-40">
                                        <div class="content-image">
                                            <img src="{{asset('imgs/cardapios/'. $p['produto']->imagem)}}" alt="">
                                        </div>
                                    </div>

                                    <div class="col-60">
                                        <div class="content-text">
                                            <h5>{{$p['quantidade']}}x {{$p['produto']->nome}}</h5>
                                            <p class="price">@money($p['valor'])</p>

                                            <a href="#" class="button-order"><i class="ti-pencil"></i>Editar</a>
                                            <a href="#" class="button-order"><i class="ti-trash"></i>Remover</a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row">
                                <div class="col-100">
                                    <form action="{{route('app.checkout')}}" method="post">
                                        @method('post')
                                        @csrf
                                        <input type="hidden" name="restaurante_id"
                                               value="{{$restaurante->empresa->id}}">
                                        <button type="submit" class="button"><i class="ti-shopping-cart-full"></i>Concluir
                                            Pedido
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else

                            <div class="row">
                                <div class="col-100">
                                    <div class="content-text">
                                       <h5>Carrinho vazio</h5>
                                        <a href="{{route('app.home', $restaurante->slug)}}" class="link-app button-order">Adicionar itens</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- end restaurant single -->
        </div>
    </div>
@endsection

