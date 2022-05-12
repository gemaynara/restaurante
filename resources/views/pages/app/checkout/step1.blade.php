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
                    Endereço de Entrega
                </div>
            </div>
        </div>
        <div class="page-content">
            <!-- reservation -->
            <div class="reservation segments-page">
                <div class="container">
                    <form class="list" method="post" action="{{route('app.checkout-step2')}}">
                        @csrf
                        <input type="hidden" name="restaurante_id" value="{{$restaurante->empresa->id}}">
                        <input type="hidden" name="slug" value="{{$restaurante->slug}}">
                        <div class="item-input-wrap input-dropdown-wrap">
                            <select placeholder="Selecione" name="endereco_id">
                                <option value="" disabled selected>Selecione um endereço</option>
                                @foreach($enderecos as $e)
                                <option value="{{$e->id}}">{{$e->endereco}} - {{$e->bairro}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="item-input-wrap input-dropdown-wrap">
                            <select placeholder="Tipo de Endereço" name="tipo">
                                <option value="" disabled selected>Tipo de Endereço</option>
                                <option value="casa">Casa</option>
                                <option value="apartamento">Apartamento</option>
                                <option value="trabalho">Trabalho</option>
                            </select>
                        </div>
                        <div class="item-input-wrap">
                            <input type="text" placeholder="CEP" name="cep" class="cep" >
                        </div>
                        <div class="item-input-wrap">
                            <input type="text" placeholder="Endereço" name="endereco"  maxlength="200">
                        </div>

                        <div class="item-input-wrap">
                            <input type="text" placeholder="Bairro" name="bairro" maxlength="50">
                        </div>

                        <div class="item-input-wrap">
                            <input type="text" placeholder="Ponto de Referência" name="complemento" maxlength="200">
                        </div>

                        {{--                        <div class="item-input-wrap input-dropdown-wrap">--}}
                        {{--                            <select placeholder="Number of Person">--}}
                        {{--                                <option value="" disabled selected>Number of Person</option>--}}
                        {{--                                <option value="1">1</option>--}}
                        {{--                                <option value="2">2</option>--}}
                        {{--                                <option value="3">3</option>--}}
                        {{--                                <option value="4">4</option>--}}
                        {{--                                <option value="5">5</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}

                        <button class="button" type="submit"><i class="ti-map-alt"></i>Prosseguir</button>
                    </form>
                </div>
            </div>
            <!-- end reservation -->
        </div>
    </div>
@endsection
