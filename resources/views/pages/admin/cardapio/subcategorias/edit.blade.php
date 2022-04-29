@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Editar sub categoria</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post"
                              action="{{route('sub-categorias-cardapio.update', $subcategoria->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="exampleInputName1">Nome</label>
                                <input type="text" class="form-control" name="nome" required value="{{$subcategoria->nome}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea1">Descrição</label>
                                <textarea class="form-control" name="descricao" rows="10"
                                          cols="30">{{$subcategoria->descricao}}</textarea>
                            </div>


                            <div class="form-group ">
                                <label>Categoria</label>
                                <select class="form-control" required name="categoria_cardapio_id">
                                    <option value="">Selecione</option>
                                    @foreach($categorias as $cat)
                                        <option
                                            value="{{$cat->id}}"
                                            {{$subcategoria->categoria_cardapio_id == $cat->id ? 'selected': ''}}>
                                            {{$cat->nome}}</option>
                                    @endforeach
                                </select>

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
