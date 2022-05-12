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
                    Pages
                </div>
            </div>
        </div>
        <div class="page-content">
            <!-- pages -->
            <div class="pages segments-page">
                <div class="container">
                    <div class="content">
                        <ul>
                            <li>
                                <a href="{{route('app.home', $restaurante->slug)}}" class="item-content item-link link-app">
                                    <div class="item-inner">
                                        <div class="item-title">
                                            <i class="ti-receipt"></i>
                                            <span>Cardápio</span>
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
{{--                            <li>--}}
{{--                                <a href="/chef/" class="item-content item-link">--}}
{{--                                    <div class="item-inner">--}}
{{--                                        <div class="item-title">--}}
{{--                                            <i class="ti-user"></i>--}}
{{--                                            <span>Chef</span>--}}
{{--                                            <i class="ti-angle-right"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="/restaurant/" class="item-content item-link">--}}
{{--                                    <div class="item-inner">--}}
{{--                                        <div class="item-title">--}}
{{--                                            <i class="ti-home"></i>--}}
{{--                                            <span>Restaurant</span>--}}
{{--                                            <i class="ti-angle-right"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li>
                                <a href="#" class="item-content item-link">
                                    <div class="item-inner">
                                        <div class="item-title">
                                            <i class="ti-calendar"></i>
                                            <span>Pedidos</span>
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
{{--                            <li>--}}
{{--                                <a href="/search/" class="item-content item-link">--}}
{{--                                    <div class="item-inner">--}}
{{--                                        <div class="item-title">--}}
{{--                                            <i class="ti-search"></i>--}}
{{--                                            <span>Search</span>--}}
{{--                                            <i class="ti-angle-right"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="/blog/" class="item-content item-link">--}}
{{--                                    <div class="item-inner">--}}
{{--                                        <div class="item-title">--}}
{{--                                            <i class="ti-rss"></i>--}}
{{--                                            <span>Blog</span>--}}
{{--                                            <i class="ti-angle-right"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li>
                                <a href="{{route('app.login', $restaurante->slug)}}" class=" item-content item-link link-app">
                                    <div class="item-inner">
                                        <div class="item-title">
                                            <i class="ti-shift-right"></i>
                                            <span>Login</span>
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('app.register', $restaurante->slug)}}" class="item-content item-link link-app">
                                    <div class="item-inner">
                                        <div class="item-title">
                                            <i class="ti-plus"></i>
                                            <span>Registrar</span>
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="/forgot-password/" class="item-content item-link">
                                    <div class="item-inner">
                                        <div class="item-title">
                                            <i class="ti-key"></i>
                                            <span>Esqueci minha senha</span>
                                            <i class="ti-angle-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end pages -->
        </div>
    </div>
@endsection
