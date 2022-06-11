@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Todos os Pedidos</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered dt">
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
