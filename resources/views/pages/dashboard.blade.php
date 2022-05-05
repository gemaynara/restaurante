@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="statistics-title">Itens no Cardápio</p>
                                            <h3 class="rate-percentage items-cardapio">0</h3>
                                        </div>
                                        <div>
                                            <p class="statistics-title">Entradas de Notas Fiscais</p>
                                            <h3 class="rate-percentage entradas">0,00</h3>
                                        </div>
                                        <div>
                                            <p class="statistics-title">Saídas Registradas Hoje</p>
                                            <h3 class="rate-percentage saidas">0,00</h3>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <p class="statistics-title">Vendas do Mês</p>
                                            <h3 class="rate-percentage">RS 1.000,00</h3>
                                        </div>
{{--                                        <div class="d-none d-md-block">--}}
{{--                                            <p class="statistics-title">New Sessions</p>--}}
{{--                                            <h3 class="rate-percentage">68.8</h3>--}}
{{--                                          --}}
{{--                                        </div>--}}
{{--                                        <div class="d-none d-md-block">--}}
{{--                                            <p class="statistics-title">Avg. Time on Site</p>--}}
{{--                                            <h3 class="rate-percentage">2m:35s</h3>--}}
{{--                                           --}}
{{--                                        </div>--}}
                                    </div>
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

        $(document).ready(function() {
            var url = window.location.origin + '/brasazd';
            $.ajax({
                url: url+ "/dashboard",
                cache: false,
                success: function (data) {
                    console.log(data)
                    $(".items-cardapio").html(data.itensCardapio);
                    $(".produtos").html(data.produtos);
                    $(".entradas").html(data.entradas);
                    $(".saidas").html(data.saidas);
                }
            });
        })


    </script>
@endpush

