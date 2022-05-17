@extends('layouts.app.app')
@section('content')
    <div class="view view-main view-init ios-edges" data-url="/">
        <div class="page page-home">
            <!-- navbar -->
        @include('layouts.app.navbar')
        <!-- end navbar -->
            <div class="page-content">
                <!-- title header -->
                <div class="title-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-70">
                                <!-- logos -->
                                <div class="logos">
                                    <h2>{{$restaurante->empresa->razao_social}}</h2>
                                </div>
                                <!-- end logos -->
                            </div>
                            <div class="col-30">
                                <!-- icon search -->
                            {{--                                <div class="icon-search">--}}
                            {{--                                    <a href="/search/"><i class="ti-search"></i></a>--}}
                            {{--                                </div>--}}
                            <!-- end icon search -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end title header -->
                <!-- slider -->
            {{--                <div class="slider">--}}
            {{--                    <div data-space-between="10" data-slides-per-view="auto"--}}
            {{--                         class="swiper-container swiper-init demo-swiper-auto">--}}
            {{--                        <div class="swiper-wrapper">--}}
            {{--                            <div class="swiper-slide">--}}
            {{--                                <div class="content">--}}
            {{--                                    <div class="mask"></div>--}}
            {{--                                    <img src="images/slider1.jpg" alt="">--}}
            {{--                                    <div class="caption">--}}
            {{--                                        <a href="/menu-single/"><h4>Fresh Grilled Salmon</h4></a>--}}
            {{--                                        <span>ABCD Restaurant</span>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="swiper-slide">--}}
            {{--                                <div class="content">--}}
            {{--                                    <div class="mask"></div>--}}
            {{--                                    <img src="images/slider2.jpg" alt="">--}}
            {{--                                    <div class="caption">--}}
            {{--                                        <a href="/menu-single/"><h4>Minced Chicken Meat</h4></a>--}}
            {{--                                        <span>Yumy de Resto</span>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="swiper-slide">--}}
            {{--                                <div class="content">--}}
            {{--                                    <div class="mask"></div>--}}
            {{--                                    <img src="images/slider3.jpg" alt="">--}}
            {{--                                    <div class="caption">--}}
            {{--                                        <a href="/menu-single/"><h4>Fresh Vegetable Burgers</h4></a>--}}
            {{--                                        <span>Special Night Cafe</span>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            <!-- end slider -->

                <!-- chef home -->
                <div class="chef-home segments">
                    <div class="container">
                        <div class="section-title">
                            <h3>Categorias
                                {{--                    <a href="/chef/" class="see-all-link">See All</a>--}}
                            </h3>
                        </div>
                        <div class="row">
                            @foreach($categorias as $ca)
                                <div class="col-10">
                                    <div class="content">
                                        <img src="{{asset('imgs/categorias/'. $ca->icone)}}" alt="">
                                        <div class="title-name">
                                            <h6>{{$ca->nome}}</h6>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- end chef home -->

                <!-- restaurant home -->
                @if(count($populares)> 0)
                    <div class="restaurant-home segments">
                        <div class="section-title">
                            <h3>Populares
                                {{--                <a href="/restaurant/" class="see-all-link">See All</a>--}}
                            </h3>
                        </div>
                        <div data-space-between="3" data-slides-per-view="auto"
                             class="swiper-container swiper-init demo-swiper-auto">
                            <div class="swiper-wrapper">
                                @foreach($populares as $p)
                                    <div class="swiper-slide">
                                        <div class="content sec">
                                            <img src="{{asset('imgs/cardapios/'. $p->imagem)}}" alt="">
                                            <div class="text">
                                                <a class="link" href="{{route('detalhe.produto', $p->id)}}">
                                                    <h4>{{$p->nome}}</h4></a>
                                                <span>{{$p->categoriasCardapio->nome}}</span>
                                                <p class="price">@money($p->valor)</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
            @endif
            <!-- end restaurant home -->
                <!-- popular menu -->
                <div class="popular-menu segments">
                    <div class="container">
                        <div class="section-title">
                            <h3> Menu
                                {{--                    <a href="/popular-menu/" class="see-all-link">See All</a>--}}
                            </h3>
                        </div>
                        <div class="row">
                            @foreach($produtos as $p)
                                <div class="col-33">
                                    <div class="content">
                                        <img src="{{asset('imgs/cardapios/'. $p->imagem)}}" alt="">
                                        <div class="text">
                                            <a class="link" href="{{route('detalhe.produto', $p->id)}}">
                                                <h4>{{$p->nome}}</h4></a>
                                            <span>{{$p->categoriasCardapio->nome}}</span>
                                            <p class="price">@money($p->valor)</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- end popular menu -->
                </div>
            </div>
        </div>

@endsection
