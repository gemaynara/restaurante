@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Empresas</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('empresas.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive table-striped">
                            <table class="table table-bordered dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome/Razão Social</th>
                                    <th>CNPJ</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($empresas as $e)
                                    <tr>
                                        <td>{{$e->id}}</td>
                                        <td>{{$e->razao_social}}</td>
                                        <td>{{$e->cnpj}}</td>
                                        <td>
                                            @if($e->ativo)
                                                <label class="badge badge-success">Ativo</label>
                                            @else
                                                <label class="badge badge-danger">Inativo</label>
                                            @endif
                                        </td>

                                        <td>
                                            <a type="button" href="{{route('empresas.edit', $e->id)}}"
                                               class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">
                                                <i class="ti-pencil text-primary"></i>
                                            </a>

                                            @if($e->ativo)
                                                <button type="button"
                                                        data-remote="{{route('empresas.desativar', $e->id)}}"
                                                        data-id="{{$e->id}}"
                                                        class="btn btn-outline-secondary btn-rounded btn-icon btn-sm disable">
                                                    <i class="ti-close text-warning"></i>
                                                </button>
                                            @else
                                                <button type="button"
                                                        data-remote="{{route('empresas.ativar', $e->id)}}"
                                                        data-id="{{$e->id}}"
                                                        class="btn btn-outline-secondary btn-rounded btn-icon btn-sm ativar">
                                                    <i class="ti-check text-warning"></i>
                                                </button>
                                            @endif

                                            <button type="button" data-remote="{{route('empresas.destroy', $e->id)}}"
                                                    data-id="{{$e->id}}"
                                                    class="btn btn-outline-secondary btn-rounded btn-icon btn-sm delete">
                                                <i class="ti-trash text-danger"></i>
                                            </button>
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
