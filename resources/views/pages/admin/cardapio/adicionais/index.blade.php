@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        @include('pages.admin.cardapio.adicionais.form')
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lista de Adicionais</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered dt">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($adicionais as $adc)
                                    <tr>
                                        <td>{{$adc->id}}</td>
                                        <td>{{$adc->nome}}</td>
                                        <td>{{$adc->valor}}</td>
                                        <td>
                                            <a type="button"
                                               href="{{route('adicionais.edit',['subcategoria'=> $subcategoria->id, 'id'=> $adc->id])}}"
                                               class="btn btn-outline-secondary btn-rounded btn-icon btn-sm">
                                                <i class="ti-pencil text-primary"></i>
                                            </a>

                                            <button type="button"
                                                    data-remote="{{route('adicionais.destroy', $adc->id)}}"
                                                    data-id="{{$adc->id}}"
                                                    class="btn btn-outline-secondary btn-rounded btn-icon btn-sm delete">
                                                <i class="ti-trash text-danger"></i>
                                            </button>

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
