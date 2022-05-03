@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Notas Fiscais</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('notas-fiscais.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Núm. Nota</th>
                                    <th>Fornecedor</th>
                                    <th>Valor Total</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notas as $n)
                                    <tr>
                                        <td>{{$n->id}}</td>
                                        <td>{{$n->numero_nota}}</td>
                                        <td>{{$n->fornecedores->razao_social}}</td>
                                        <td>@money($n->valor_total)</td>
                                        <td><label class="badge badge-info">{{$n->situacao}}</label></td>
                                        <td>
                                            <a type="button" href="{{route('notas-fiscais.show', $n->id)}}"
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
