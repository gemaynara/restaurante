@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            @include('layouts.partials.alerts')
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cardápio</h4>
                        <div class="table-responsive">
                            <table class="table dt">
                                <thead>
                                <tr>
                                    <th class="pt-1 ps-0">
                                        Item
                                    </th>
                                    <th class="pt-1">
                                        Ações
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($produtos as $p)
                                        <td class="py-1 ps-0">
                                            <div class="d-flex align-items-center">
                                                <img src="{{asset('imgs/cardapios/'. $p->imagem)}}" alt="imagem">
                                                <div class="ms-3">
                                                    <p class="mb-0">{{$p->nome}}</p>
                                                    <p class="mb-0 text-muted text-small">{{$p->categoriasCardapio->nome}}
                                                        - Serve {{$p->quantidade_servida}} pessoa(s)</p>
                                                    <p class="mb-0 text-muted text-small font-weight-bold"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-produto-{{$p->id}}">Adicionar
                                            </button>
                                            @include('pages.admin.pedidos.modal-produto')
                                        </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <a type="button" href="{{route('pedidos.comanda', $pedido->numero_pedido)}}" target="_blank"
                           class="btn btn-success btn-rounded btn-icon btn-sm float-right"
                           style="float: right!important;"
                           title="Imprimir comanda">
                            <i class="ti-printer"></i>
                        </a>
                        <h4 class="card-title">Comanda Núm.{{$pedido->numero_pedido}}</h4>
                        <p>{{!is_null($pedido->nome)? 'Cliente: '. $pedido->nome : ''}}</p>
                        <span>Mesa {{$pedido->mesas->codigo}}</span>
                        <div class="table-responsive table-sm mt-2">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="pt-1 ps-0">
                                        Item
                                    </th>
                                    <th class="pt-1 ps-0">
                                        Subtotal
                                    </th>
                                    <th class="pt-1">
                                        Ações
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $enviar = false; $cancel = false;
                                count($pedido->detalhes) == 0 ? $cancel = true : $cancel = false?>
                                @if(count($pedido->detalhes) == 0)
                                    <tr>
                                        <td>Sem Pedidos</td>
                                    </tr>
                                @else
                                    <tr>

                                        @foreach($pedido->detalhes as $p)
                                            <?php $adicionais = 0.00; $p->enviado == 'S' ? $enviar = false : $enviar = true;?>
                                            <td class="py-1 ps-0">
                                                <div class="d-flex align-items-center">
{{--                                                    <img src="{{asset('imgs/cardapios/'. $p->cardapio->imagem)}}" width="50px"--}}
{{--                                                         alt="profile">--}}
                                                    <div class="ms-3">
                                                        <p class="mb-0" style="word-break: break-all;">{{$p->quantidade}} x {{$p->cardapio->nome}}</p>
                                                        <p class="mb-0 text-muted text-small">
                                                            Vl. Unit. @money($p->cardapio->valor)
                                                        </p>
                                                        {{--                                                            @money($p->valor_subtotal)</p>--}}
                                                        @foreach($p->adicionais as $adc)
                                                            <span class="mb-0 text-muted text-small">- {{$adc->adicionalPedido->nome}} - @money($adc->subtotal)</span>
                                                            <?php $adicionais += $adc->subtotal?>
                                                            <br>
                                                        @endforeach

                                                        <p class="mb-0 text-muted text-small">{{!is_null($p->observacoes)? 'Obs.:'.$p->observacoes: ''}}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>@money($p->valor_subtotal+$adicionais)</td>
                                            <td>
                                                @if($p->enviado == 'S' && $p->produzido == 'N')
                                                    <div class="badge badge-outline-primary">Em Produção</div>
                                                    <p class="mb-0 text-muted text-small">
                                                        às {{\Carbon\Carbon::parse($p->updated_at)->format('H:i')}}
                                                    </p>
                                                @elseif($p->produzido == 'S')
                                                    <div class="badge badge-outline-primary">Produzido</div>
                                                    <p class="mb-0 text-muted text-small">
                                                        às {{\Carbon\Carbon::parse($p->updated_at)->format('H:i')}}
                                                    </p>
                                                @else
                                                    <button type="button"
                                                            class="btn btn-outline-secondary btn-rounded btn-icon btn-sm small"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-editar-{{$p->id}}"><i
                                                            class="ti-pencil text-warning"></i>
                                                    </button>

                                                    @include('pages.admin.pedidos.modal-editar')

                                                    <button type="button"
                                                            data-remote="{{route('pedidos.remove-item', $p->id)}}"
                                                            data-id="{{$p->id}}"
                                                            class="btn btn-outline-secondary btn-rounded btn-icon btn-sm delete">
                                                        <i class="ti-trash text-danger"></i>
                                                    </button>
                                                @endif
                                            </td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="pt-1 ps-0" colspan="4">
                                        <h4 class="mt-2"> Subtotal: @money($pedido->subtotal+$pedido->adicionais)</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-1 ps-0" colspan="4">
                                        <h4 class="mt-2"> Taxa: @money($pedido->taxa)</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-1 ps-0" colspan="4">
                                        <h4 class="mt-2"> Descontos: @money($pedido->desconto)</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-1 ps-0" colspan="4">
                                        <h4 class="mt-2"> Valor Total: @money($pedido->total)</h4>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                            @if($cancel)
                                <a href="{{route('pedidos.cancelar-comanda')}}" data-id="{{$pedido->id}}"
                                   class="btn btn-danger float-right mt-4 cancel-comanda
 {{$pedido->status_pedido == 'Pedido Cancelado' || $pedido->status_pedido == 'Pedido Finalizado' ? 'disabled': ''}}">Cancelar Comanda</a>
{{--                                <form action="{{route('pedidos.cancelar-comanda')}}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="numero_pedido" value="{{$pedido->numero_pedido}}">--}}
{{--                                    <button type="submit" class="btn btn-block btn-info">Cancelar Comanda</button>--}}
{{--                                </form>--}}
                            @endif
                            @if(isset($enviar))
                                @if(($enviar))
                                    <form action="{{route('pedidos.enviar-pedido')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="numero_pedido" value="{{$pedido->numero_pedido}}">
                                        <button type="submit" class="btn btn-block btn-info">Enviar Pedido</button>
                                    </form>
                                @endif

                                @if($pedido->status_pedido != 'Comanda Encerrada' && $enviar == false && count($pedido->detalhes)>0)
                                    <form action="{{route('pedidos.encerrar-pedido')}}" method="post" class="mt-2">
                                        @csrf
                                        <input type="hidden" name="numero_pedido" value="{{$pedido->numero_pedido}}">
                                        <button type="submit" class="btn btn-block btn-success">Encerrar Comanda
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
