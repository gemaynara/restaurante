@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Mesas</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('mesas.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive table-striped">
                            <table class="table table-bordered dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Código</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mesas as $m)
                                    <tr>
                                        <td>{{$m->id}}</td>
                                        <td>{{$m->codigo}}</td>
                                        <td>{{$m->situacao}}</td>

                                        <td>
{{--                                            <a type="button" href="{{route('setores.edit', $s->id)}}"--}}
{{--                                               class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">--}}
{{--                                                <i class="ti-pencil text-primary"></i>--}}
{{--                                            </a>--}}

                                            <button type="button" data-remote="{{route('mesas.destroy', $m->id)}}"
                                                    data-id="{{$m->id}}"
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
