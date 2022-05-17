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
                        @if(count($pedido->detalhes)>0)
                        <div class="row">
                            @foreach($pedido->detalhes  as $p)
                                <div class="col-40 mt-2">
                                    <div class="content-image">
                                        <img src="{{asset('imgs/cardapios/'. $p->cardapio->imagem)}}" alt="">
                                    </div>
                                </div>

                                <div class="col-60 mt-2">
                                    <div class="content-text">
                                        <h5>{{$p->quantidade}}x {{$p->cardapio->nome}}</h5>
                                        <p class="price">@money($p->valor_subtotal)</p>
                                        <span>{{$p->observacoes}}</span>

                                        @if(!is_null($p->adicionais))
                                            @foreach($p->adicionais as $adc)
                                                <span>- {{$adc->adicionalPedido->nome}} - @money($adc->subtotal)</span>
                                                <br>
                                            @endforeach
                                        @endif

                                        <div>
                                            <a href="#" class="button-order"><i class="ti-pencil"></i>Editar</a>
                                            <form action="">
                                                <a href="{{route('remove.item', $p->id)}}" class="button-order"><i class="ti-trash"></i>Remover</a>
                                            </form>

                                        </div>

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
                                                               <h5>Sem itens</h5>
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

