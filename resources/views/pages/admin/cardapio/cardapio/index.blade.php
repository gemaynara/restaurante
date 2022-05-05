@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cardápio</h4>
                        @include('layouts.partials.alerts')
                        <p class="card-description float-right">
                            <a href="{{route('cardapios.create')}}" type="button"
                               class="btn btn-dark btn-rounded btn-fw">Novo Registro</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Imagem</th>
                                    <th>Tempo Preparo</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cardapios as $ca)
                                    <tr>
                                        <td>{{$ca->id}}</td>
                                        <td>{{$ca->nome}}</td>
                                        <td>{{\Illuminate\Support\Str::limit($ca->descricao, 10)}}</td>
                                        <td><img src="{{asset('imgs/cardapios/'. $ca->imagem)}}" alt="" width="50px">
                                        </td>
                                        <td>{{$ca->tempo_preparo}}</td>
                                        <td>
                                            @if($ca->ativo)
                                                <label class="badge badge-success">Ativo</label>
                                            @else
                                                <label class="badge badge-danger">Inativo</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a type="button" href="{{route('cardapios.edit', $ca->id)}}"
                                               class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">
                                                <i class="ti-pencil text-primary"></i>
                                            </a>

                                            @if($ca->ativo)
                                                <button type="button"
                                                        data-remote="{{route('cardapios.desativar', $ca->id)}}"
                                                        data-id="{{$ca->id}}"
                                                        class="btn btn-outline-secondary btn-rounded btn-icon btn-sm disable">
                                                    <i class="ti-close text-warning"></i>
                                                </button>
                                            @else
                                                <button type="button"
                                                        data-remote="{{route('cardapios.ativar', $ca->id)}}"
                                                        data-id="{{$ca->id}}"
                                                        class="btn btn-outline-secondary btn-rounded btn-icon btn-sm ativar">
                                                    <i class="ti-check text-warning"></i>
                                                </button>
                                            @endif
                                            <button type="button"
                                                    data-remote="{{route('cardapios.destroy', $ca->id)}}"
                                                    data-id="{{$ca->id}}"
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
