@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Editar setor</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('setores.update', $setor->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="exampleInputName1">Nome</label>
                                <input type="text" class="form-control" name="nome" required value="{{$setor->nome}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea1">Descrição</label>
                                <textarea class="form-control" name="descricao" rows="8">{{$setor->descricao}}</textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            <button class="btn btn-light">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
