@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                @include('layouts.partials.alerts')
                <div class="card">
                    <div class="card-body">
                        <div class="container text-center pt-5">
                            <h4 class="mb-3 mt-5">Painel {{$setor->nome}}</h4>
                            <div class="row pricing-table justify-content-center">
                                @foreach($pedidos as $key=>$p)
                                    <div class="col-md-3 col-xl-3 grid-margin stretch-card pricing-card">
                                        <div class="card border-primary border pricing-card-body">
                                            <div class="text-center pricing-card-head">
                                                <h4 class="fw-normal mb-4">Pedido {{$p->tipo_pedido}}</h4>
                                                @if(!is_null($p->mesas))
                                                    <h3>Mesa {{$p->mesas->codigo}}</h3>
                                                @endif
                                                {{--                                                <h1 class="fw-normal mb-4">$00.00</h1>--}}
                                            </div>
                                            <ul class="list-unstyled plan-features">
                                                <?php $preparo = \Carbon\Carbon::createFromTime('00', '00'); ?>
                                                <?php $tempoPreparo = 00 ?>
                                                <?php $horaPedido = 00 ?>
                                                @foreach($p->detalhes as $item)
                                                    @if($item->cardapio->setor_id == $setor->id)
                                                        <li>{{$item->quantidade}} x {{$item->cardapio->nome}}</li>
                                                        @foreach($item->adicionais as $adc)
                                                            <small
                                                                style="float: left!important;font-size: 12px">- {{$adc->quantidade}}
                                                                x{{$adc->adicionalPedido->nome}}</small>
                                                            <br>
                                                        @endforeach
                                                        <small class="pb-3">@if(!is_null($item->observacoes))
                                                                -Obs.: {{$item->observacoes}}@endif</small>
                                                        @if(strtotime($item->cardapio->tempo_preparo) >= strtotime($preparo))
                                                            <?php $preparo = ($item->cardapio->tempo_preparo) ?>
                                                        @endif
                                                        <?php $timesplit = explode(':', $preparo);
                                                        $tempoPreparo = ($timesplit[0] * 60) + ($timesplit[1]) + ($timesplit[2] > 30 ? 1 : 0);
                                                        ?>

                                                        @if(strtotime($item->created_at) >= strtotime($horaPedido))
                                                            <?php $horaPedido = $item->created_at ?>
                                                        @endif

                                                    @endif
                                                @endforeach
                                            </ul>
                                            <hr>

                                            <div class="text-center pricing-card-head">
                                                <p>Hora Pedido:
                                                    <span> {{\Carbon\Carbon::parse($horaPedido)->format('H:i')}}</span>
                                                </p>
                                                <p>Tempo de espera: <span> {{$tempoPreparo}} min.</span></p>

                                                <?php $prazoLimite = \Carbon\Carbon::parse($horaPedido)->addRealMinutes($tempoPreparo)?>

                                                <?php $now = \Carbon\Carbon::now(); ?>
                                                <?php $prazo = $prazoLimite->diff($now)->format('%H:%I'); ?>
                                                @if(strtotime($now) > strtotime($prazoLimite))
                                                    <p class="font-weight-500 text-danger"> Em Atraso: {{$prazo}}min</p>
                                                @else
                                                    <p class="font-weight-500 text-danger"> Prazo: {{$prazo}}min</p>
                                                @endif

                                            </div>
                                            <div class="wrapper">

                                                <a type="button" class="btn btn-warning confirmar-pedido"
                                                   data-id="{{$p->id}}"
                                                   data-setor="{{$setor->id}}"
                                                   data-remote="{{route('producao.confirmar', ['id'=>$p->id, 'novoStatus'=>"Pedido $setor->nome Produzido"])}}">
                                                    Confirmar Pedido</a>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <div class="right-center pull-right">
                            <p>
                                Data: <span>{{\Carbon\Carbon::parse(now())->format("d/m/Y")}}</span>
                                Hora: <span id="hora"></span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
@push('scripts')
    <script>
        const zeroFill = n => {
            return ('0' + n).slice(-2);
        }
        const interval = setInterval(() => {
            const now = new Date();
            document.getElementById('hora').innerHTML = zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes())
                + ':' + zeroFill(now.getSeconds());
        }, 100);

        setInterval(() => {
            location.reload();
        }, 10000);


        $(".confirmar-pedido").on('click', function (e) {
            e.preventDefault();
            var url = $(this).data('remote');
            var id = $(this).data("id");
            var setor = $(this).data("setor");

            Swal.fire({
                icon: "question",
                title: "Você confirma o pedido?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Sim',
                denyButtonText: `Não`,
                showLoaderOnConfirm: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        data: {
                            "id": id,
                            "setor": setor,
                        },
                        type: 'POST',
                        success: function (response) {
                            Swal.fire(
                                "Sucesso!",
                                'Pedido confirmado!.',
                                'success'
                            )
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        },
                        error: function (response) {
                            Swal.fire(
                                "Erro!",
                                'Ocorreu um erro.',
                                'success'
                            )
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            })
        });


    </script>
@endpush
