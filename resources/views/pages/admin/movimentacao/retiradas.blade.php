@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Retiradas do Caixa</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <button type="button" class="btn  btn-info btn-block"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-retirada">Inserir Registro
                            </button>
                            @include('pages.admin.movimentacao.modal-retirada')
                        </p>
                        <div class="table-responsive">
                            <table class="table dt">
                                <thead>
                                <tr>
                                    <th class="pt-1 ps-0">
                                        Identificação
                                    </th>
                                    <th class="pt-1 ps-0">
                                        Tipo de Movimentação
                                    </th>
                                    <th class="pt-1 ps-0">
                                       Operador
                                    </th>
                                    <th class="pt-1">
                                        Valor
                                    </th>
                                    <th class="pt-1">
                                        Descrição
                                    </th>
                                    <th class="pt-1">
                                        Data
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($movimentacoes as $mov)
                                        <td class="py-1 ps-0">
                                            <div class="d-flex align-items-center">
                                                <label class="badge badge-success">{{$mov->tipo_identificacao}}</label>
                                                {{--                                                <img src="../../../../images/faces/face1.jpg" alt="profile">--}}

                                            </div>
                                        </td>
                                        <td>
                                            <div class="ms-3">
                                                <label class="badge badge-success">{{$mov->tipo_movimentacao}}</label>
                                            </div>
                                        </td>
                                        <td>
                                            {{$mov->usuarios->name}}
                                        </td>

                                        <td>
                                            @money($mov->valor_pago-$mov->valor_troco)
                                        </td>
                                        <td>
                                            {{$mov->descricao}}
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($mov->created_at)->format('d/m/Y H:i:s')}}
                                        </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
