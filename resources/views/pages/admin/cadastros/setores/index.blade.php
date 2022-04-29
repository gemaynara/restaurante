@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Setores</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('setores.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($setores as $s)
                                    <tr>
                                        <td>{{$s->id}}</td>
                                        <td>{{$s->nome}}</td>
                                        <td>{{$s->descricao}}</td>

                                        <td>
                                            <a type="button" href="{{route('setores.edit', $s->id)}}"
                                               class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">
                                                <i class="ti-pencil text-primary"></i>
                                            </a>

                                            <button type="button" data-remote="{{route('setores.destroy', $s->id)}}"
                                                    data-id="{{$s->id}}"
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
