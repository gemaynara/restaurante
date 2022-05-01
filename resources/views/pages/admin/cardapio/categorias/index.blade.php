@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Categorias</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('categorias-cardapio.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Ícone</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categorias as $cat)
                                    <tr>
                                        <td>{{$cat->id}}</td>
                                        <td>{{$cat->nome}}</td>
                                        <td>{{$cat->descricao}}</td>
                                        <td><img src="{{asset('imgs/categorias/'. $cat->icone)}}" alt="" width="50px"></td>
                                        <td>
                                            <a type="button" href="{{route('categorias-cardapio.edit', $cat->id)}}" class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">
                                                <i class="ti-pencil text-primary"></i>
                                            </a>

                                            <button type="button" data-remote="{{route('categorias-cardapio.destroy', $cat->id)}}"
                                                    data-id="{{$cat->id}}"
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
