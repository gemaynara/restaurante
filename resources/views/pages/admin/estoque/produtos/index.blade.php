@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Produtos</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('produtos.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Und. Medida</th>
                                    <th>Estoque</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($produtos  as $p)
                                    <tr>
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->nome}}</td>
                                        <td>{{$p->categoriasProduto->nome}}</td>
                                        <td>{{$p->unidade}}</td>
                                        <td>{{$p->estoque}}</td>
                                        <td>@money($p->valor)</td>

                                        <td>
                                            <a type="button" href="{{route('produtos.edit', $p->id)}}"
                                               class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">
                                                <i class="ti-pencil text-primary"></i>
                                            </a>

                                            <button type="button"
                                                    data-remote="{{route('produtos.destroy', $p->id)}}"
                                                    data-id="{{$p->id}}"
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
