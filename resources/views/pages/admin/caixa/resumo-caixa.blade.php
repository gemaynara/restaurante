@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Resumo de Caixa</h4>
                        {{--                        <p class="card-description">--}}
                        {{--                            Basic form layout--}}
                        {{--                        </p>--}}
                        <form class="forms-sample" action="{{route('caixa.pdf-resumo')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Data</label>
                                        <input type="date" class="form-control" name="data" required>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group pt-4 mt-2">
                                        <button type="submit" class="btn btn-block btn-primary me-2">Gerar Relatório
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
