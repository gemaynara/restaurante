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
                    Criar Conta
                </div>
            </div>
        </div>
        <div class="page-content">
            <!-- register -->
            <div class="register segments-page">
                <div class="container">
                    <form class="list" action="{{route('app.post-register')}}" method="post">
                        @csrf
                        <input type="hidden" name="slug" value="{{$restaurante->slug}}">
                        <input type="hidden" name="restaurante_id" value="{{$restaurante->empresa->id}}">
                        <div class="item-input-wrap">
                            <input type="text" placeholder="Nome" required name="name" value="{{old('name')}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="item-input-wrap">
                            <input type="text" placeholder="WhatsApp" class="telefone" required name="telefone" value="{{old('telefone')}}">
                        </div>
                        <div class="item-input-wrap">
                            <input type="email" placeholder="E-mail" required name="email" value="{{old('email')}}">
                        </div>

                        <div class="item-input-wrap">
                            <input type="password" placeholder="Senha" required name="password" id="password">
                        </div>
                        <div class="item-input-wrap">
                            <input type="password" placeholder="Confirme a Senha" required
                                   id="password-confirm" name="password_confirmation">
                        </div>
                        <button type="submit" class="button"><i class="ti-user"></i>Registrar</button>
                    </form>
                    <div class="register-with">
                        <p>Ou Registrar Com</p>
                        <ul>
                            <li><a href="#"><i class="ti-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end register -->
        </div>
    </div>
@endsection
