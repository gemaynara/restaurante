@extends('layouts.app.app')
@section('content')
    <div class="view view-main view-init ios-edges" data-url="/">
        <div class="page page-home">
            <!-- navbar -->
        {{--        @include('layouts.app.navbar')--}}
        <!-- end navbar -->
            <div class="page-content">

                <div class="page">
                    <div class="navbar navbar-page">
                        <div class="navbar-inner sliding">
                            <div class="left">
                                <a href="{{route('app.home', $restaurante->slug)}}" class="link back">
                                    <i class="ti-arrow-left"></i>
                                </a>
                            </div>
                            {{--            <div class="right">--}}
                            {{--                <a href="#"><i class="ti-heart"></i></a>--}}
                            {{--            </div>--}}
                        </div>
                    </div>
                    <div class="page-content">
                        <!-- menu single -->
                        <div class="menu-single segments-page">
                            <div class="container">
                                <div class="header">
                                    <img src="{{asset('imgs/cardapios/'. $produto->imagem)}}" alt="">
                                </div>
                                <form action="{{route('add.produto')}}" method="POST">
                                    @method('post')
                                    @csrf
                                    <input type="hidden" name="id_produto" value="{{$produto->id}}">
                                    <input type="hidden" name="empresa" value="{{$produto->empresa_id}}">
                                    <div class="desc">
                                        <p class="price">@money($produto->valor)</p>
                                        <span>{{$produto->categoriasCardapio->nome}}</span>
                                        <h4>{{$produto->nome}}</h4>
                                        <p>{{$produto->descricao}}</p>

                                        <div class="row" style="padding-top: 20px">
                                            <div class="col-25">
                                                <a href="" class="button btn-minus">
                                                    <i class="ti-minus"></i>
                                                </a>
                                            </div>
                                            <div class="col-50" style="text-align: center!important;">
                                                <label>Quantidade</label>
                                                <input type="text" class="qnt" value="1"
                                                       style="text-align: center!important;"
                                                       name="quantidade">
                                            </div>
                                            <div class="col-25">
                                                <a href="" class="button btn-plus">
                                                    <i class="ti-plus"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="row mt-5">
                                            <span class="text-center">Adicionais</span>
                                            <div class="d-flex gap-5 justify-content-center col-12">
                                                <div class="list-group mx-0 w-auto col-100">
                                                    @foreach($adicionais as $key=> $adc)
                                                        <label class="list-group-item d-flex gap-2">
                                                            <input class="form-check-input flex-shrink-0"
                                                                   type="checkbox"
                                                                   value="{{$adc->id}}_{{$adc->valor}}" name="adicionais[]">
                                                            <span>{{$adc->nome}} - @money($adc->valor)</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="">
                                                <textarea placeholder="Insira as observações aqui"
                                                          name="observacoes" maxlenght="100"></textarea>
                                            </div>

                                        </div>


                                        <button class="button"><i class="ti-shopping-cart"></i>Adicionar ao Carrinho
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end menu single -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(".btn-minus").on('click', function (e) {
            e.preventDefault();
            var qnt = $(".qnt").val();
            if (qnt > 1) {
                qnt = parseInt(qnt) - 1;
                $(".qnt").val(qnt);
            } else {
                $(".qnt").val(1);
            }
        })

        $(".btn-plus").on('click', function (e) {
            e.preventDefault();
            var qnt = $(".qnt").val();
            if (qnt >= 1) {
                qnt = parseInt(qnt) + 1;
                $(".qnt").val(qnt);
            } else {
                $(".qnt").val(1);
            }
        })
    </script>
@endpush
