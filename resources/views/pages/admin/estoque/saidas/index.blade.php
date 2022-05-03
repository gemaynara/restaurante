@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Retiradas do Estoque</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('saidas.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Usuário</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($saidas as $s)
                                    <tr>
                                        <td>{{$s->id}}</td>
                                        <td>{{$s->usuarios->name}}</td>
                                        <td>{{$s->observacoes}}</td>
                                        <td>{{\Carbon\Carbon::parse($s->created_at)->format('d/m/Y')}}</td>
                                        <td><label class="badge badge-info">{{$s->situacao}}</label></td>
                                        <td>
                                            <a type="button" href="{{route('saidas.show', $s->id)}}"
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
