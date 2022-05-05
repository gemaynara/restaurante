@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Usuários</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('users.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Usuário</th>
                                    <th>E-mail</th>
                                    <th>Empresa</th>
                                    <th>Perfil</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->empresa->razao_social }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->active)
                                                <label class="badge badge-success">Ativo</label>
                                            @else
                                                <label class="badge badge-danger">Inativo</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a type="button" href="{{route('users.edit', $user->id)}}"
                                               class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">
                                                <i class="ti-pencil text-primary"></i>
                                            </a>

                                            @if($user->active)
                                                <button type="button"
                                                        data-remote="{{route('users.desativar', $user->id)}}"
                                                        data-id="{{$user->id}}"
                                                        class="btn btn-outline-secondary btn-rounded btn-icon btn-sm disable">
                                                    <i class="ti-close text-warning"></i>
                                                </button>
                                            @else
                                                <button type="button"
                                                        data-remote="{{route('users.ativar', $user->id)}}"
                                                        data-id="{{$user->id}}"
                                                        class="btn btn-outline-secondary btn-rounded btn-icon btn-sm ativar">
                                                    <i class="ti-check text-warning"></i>
                                                </button>
                                            @endif

                                            <button type="button" data-remote="{{route('users.destroy', $user->id)}}"
                                                    data-id="{{$user->id}}"
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
