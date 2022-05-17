@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inserir nova mesa</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('mesas.store')}}" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="exampleInputName1">Código</label>
                                <input type="text" class="form-control qnt" name="codigo" required value="{{old('codigo')}}">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            <a type="button" href="{{route('mesas.index')}}" class="btn btn-light">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
