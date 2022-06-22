@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-4 grid-margin">
                <div class="card bg-facebook d-flex align-items-start">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-start">
                            <i class="ti-view-list text-white icon-md"></i>
                            <div class="ms-3">
                                <h6 class="text-white">{{$finalizados}}</h6>
                                <p class="mt-2 text-white card-text">Pedidos Finalizados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin">
                <div class="card bg-linkedin d-flex align-items-start">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-start">
                            <i class="ti-time text-white icon-md"></i>
                            <div class="ms-3">
                                <h6 class="text-white">{{$fila}}</h6>
                                <p class="mt-2 text-white card-text">Pedidos na Fila</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin">
                <div class="card bg-youtube d-flex align-items-start">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-start">
                            <i class="ti-close text-white icon-md"></i>
                            <div class="ms-3">
                                <h6 class="text-white">{{$cancelados}}</h6>
                                <p class="mt-2 text-white card-text">Pedidos Cancelados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Todos os Pedidos</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-desc">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Número Pedido</th>
                                    <th>Tipo</th>
                                    <th>Mesa</th>
                                    <th>Data</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pedidos as $p)
                                    <tr>
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->numero_pedido}}</td>
                                        <td><label class="badge badge-success">{{$p->tipo_pedido}}</label></td>
                                        <td>{{!is_null($p->mesas) ?$p->mesas->codigo: '-'}}</td>
                                        <td>{{\Carbon\Carbon::parse($p->created_at)->format('d/m/Y')}}</td>
                                        <td><label class="badge badge-info">{{$p->status_pedido}}</label></td>
                                        <td>
                                            <a type="button" href="{{route('pedidos.show', $p->id)}}"
                                               class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">
                                                <i class="ti-eye text-primary"></i>
                                            </a>
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
