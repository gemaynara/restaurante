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
                    Login
                </div>
            </div>
        </div>
        <div class="page-content">
            <!-- login -->
            <div class="login segments-page">
                <div class="container">
                    <div class="logos">
                        <div class="image">
                            <img src="{{asset('imgs/empresas/'. $restaurante->logo)}}" alt="">
                        </div>
                    </div>
                    <form class="list" method="post" action="{{route('app.post-login')}}">
                        @csrf
                        <input type="hidden" name="slug" value="{{$restaurante->slug}}">
                        <div class="item-input-wrap">
                            <input type="email" placeholder="E-mail" required name="email" value="{{old('email')}}">
                        </div>
                        <div class="item-input-wrap no-mb">
                            <input type="password" placeholder="Senha" required name="password">
                        </div>
                        <label class="item-checkbox item-content no-ripple">
                        </label>
                        <button class="button" type="submit"><i class="ti-shift-right"></i>Entrar</button>
                    </form>
                    <div class="forgot-link">
                        <a href="/forgot-password/">Esqueci a senha</a>
                    </div>
                    <div class="forgot-link">
                        <a href="{{route('app.register', $restaurante->slug)}}" class="link-app">Criar Conta</a>
                    </div>
                    <div class="login-with">
                        <p>Ou conectar com </p>
                        <ul>
                            <li><a href="#"><i class="ti-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end login -->
        </div>
    </div>
@endsection
