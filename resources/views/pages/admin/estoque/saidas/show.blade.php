@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card px-2">
                    <div class="card-body">
                        <div class="container-fluid">
                            <h3 class="text-right my-5">Visualizar Saída</h3>
                            <hr>
                        </div>
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 ps-0">
                                <p class="mt-5 mb-2"><b>Descrição: {{$saida->observacoes}}</b></p>
                            </div>
                            <div class="col-lg-3 pr-0">
                                <p class="mt-5 mb-2 text-right"><b>Usuário: {{$saida->usuarios->name}}</b></p>

                            </div>
                        </div>
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-3 ps-0">
                                <p class="mb-0 mt-5">Data de Criação : {{\Carbon\Carbon::parse($saida->created_at)->format('d/m/Y')}}</p>
                                {{--                                <p>Due Date : 25th Jan 2017</p>--}}
                            </div>
                        </div>
                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table">
                                    <thead>
                                    <tr class="bg-dark text-white">
                                        <th>#ID</th>
                                        <th>Produto</th>
                                        <th>Und.</th>
                                        <th class="text-right">Quantidade</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($saida->detalhes as $det)
                                        <tr class="text-right">
                                            <td class="text-left">{{$det->produtos->id}}</td>
                                            <td class="text-left">{{$det->produtos->nome}}</td>
                                            <td class="text-left">{{$det->produtos->unidade}}</td>
                                            <td>{{$det->quantidade}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="container-fluid w-100">
                            {{--                            <a href="#" class="btn btn-primary float-right mt-4 ms-2"><i class="ti-printer me-1"></i>Print</a>--}}
                            <a href="{{route('saidas.index')}}" class="btn btn-success float-right mt-4">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
