@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card px-2">
                    <div class="card-body">
                        <div class="container-fluid">
                            <h3 class="text-right my-5">Visualizar Nota Fiscal</h3>
                            <hr>
                        </div>
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 ps-0">
                                <p class="mt-5 mb-2"><b>Fornecedor: {{$nota->fornecedores->razao_social}} </b></p>
                                <p>CNPJ: {{$nota->fornecedores->cnpj}}</p>
                            </div>
                            <div class="col-lg-3 pr-0">
                                <p class="mt-5 mb-2 text-right"><b>Natureza: {{$nota->natureza}}</b></p>
                                <p class="text-right">Valor Frete: @money($nota->valor_frete)</p>
                                <p class="text-right">Valor Desconto: @money($nota->valor_desconto)</p>
                            </div>
                        </div>
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-3 ps-0">
                                <p class="mb-0 mt-5">Data de Criação : {{\Carbon\Carbon::parse($nota->created_at)->format('d/m/Y')}}</p>
{{--                                <p>Due Date : 25th Jan 2017</p>--}}
                            </div>
                        </div>
                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table">
                                    <thead>
                                    <tr class="bg-dark text-white">
                                        <th>#</th>
                                        <th>Produto</th>
                                        <th>Und.</th>
                                        <th class="text-right">Quantidade</th>
                                        <th class="text-right">Valor Unitário</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($nota->detalhes as $det)
                                    <tr class="text-right">
                                        <td class="text-left">{{$det->produtos->id}}</td>
                                        <td class="text-left">{{$det->produtos->nome}}</td>
                                        <td class="text-left">{{$det->produtos->unidade}}</td>
                                        <td>{{$det->quantidade}}</td>
                                        <td>@money($det->valor_unitario)</td>
                                        <td>@money($det->subtotal)</td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="container-fluid mt-5 w-100">
{{--                            <p class="text-right mb-2">Sub - Total amount: $12,348</p>--}}
{{--                            <p class="text-right">vat (10%) : $138</p>--}}
                            <h4 class="text-right mb-5">Total : @money($nota->valor_total)</h4>
                            <hr>
                        </div>
                        <div class="container-fluid w-100">
{{--                            <a href="#" class="btn btn-primary float-right mt-4 ms-2"><i class="ti-printer me-1"></i>Print</a>--}}
                            <a href="{{route('notas-fiscais.index')}}" class="btn btn-success float-right mt-4">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
