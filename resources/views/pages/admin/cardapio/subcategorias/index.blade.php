@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Sub Categorias</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('sub-categorias-cardapio.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Categoria</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subcategorias as $sub)
                                    <tr>
                                        <td>{{$sub->id}}</td>
                                        <td>{{$sub->nome}}</td>
                                        <td>{{$sub->descricao}}</td>
                                        <td>{{$sub->categoriaCardapio->nome}}</td>
                                        <td>
                                            <a type="button" href="{{route('sub-categorias-cardapio.edit', $sub->id)}}"
                                               class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">
                                                <i class="ti-pencil text-primary"></i>
                                            </a>

                                            <button type="button"
                                                    data-remote="{{route('sub-categorias-cardapio.destroy', $sub->id)}}"
                                                    data-id="{{$sub->id}}"
                                                    class="btn btn-outline-secondary btn-rounded btn-icon btn-sm delete">
                                                <i class="ti-trash text-danger"></i>
                                            </button>


                                            <a type="button" href="{{route('sub-categorias-cardapio.edit', $sub->id)}}"
                                               class="btn btn-outline-dark btn-rounded btn-icon btn-sm">
                                                <i class="ti-plus text-primary"></i> Adicionais
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
