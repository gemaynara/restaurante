@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Relatório de Vendas</h4>
                        {{--                        <p class="card-description">--}}
                        {{--                            Basic form layout--}}
                        {{--                        </p>--}}
                        <form class="forms-sample" action="{{route('cardapio.vendas-pdf')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Data Inicial</label>
                                        <input type="date" class="form-control" name="data_inicial" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Data Final</label>
                                        <input type="date" class="form-control" name="data_final" required>
                                    </div>
                                </div>


                            </div>
                            <button type="submit" class="btn btn-primary me-2">Gerar Relatório</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
