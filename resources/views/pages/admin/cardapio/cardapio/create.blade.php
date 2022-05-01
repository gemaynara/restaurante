@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inserir Registro</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('cardapios.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nome</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nome" value="{{old('nome')}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Valor</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control valor" name="valor"
                                                   value="{{old('valor')}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Setor</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="setor_id" required>
                                                <option value="">Selecione</option>
                                                @foreach($setores as $list)
                                                    <option value="{{$list->id}}">{{$list->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Categoria</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="categoria_cardapio_id" id="categoria" required>
                                                <option value="">Selecione</option>
                                                @foreach($categorias as $list)
                                                    <option value="{{$list->id}}">{{$list->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Sub Categoria</label>
                                        <div class="col-sm-9">
                                            <select class="form-control subcategoria" name="subcategoria_cardapio_id" id="subcategoria_id" required>
                                                <option value="">Selecione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tempo de Preparo</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control time" name="tempo_preparo"
                                                   value="{{old('tempo_preparo')}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Und. Medida</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control " name="medida"
                                                   value="{{old('medida')}}" required maxlength="10">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Núm Porções</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control qnt" name="quantidade_servida"
                                                   value="{{old('quantidade_servida')}}" maxlength="5">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Descrição</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="descricao"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Imagem</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="imagem"
                                                   onchange="previewFile(this)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <img src="" alt="" id="img" width="150px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            <a class="btn btn-light" href="{{route('cardapios.index')}}">Cancelar</a>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>

        $(document).ready(function () {
            $("#categoria").on('change', function (e) {
                e.preventDefault()
                var categoria = $(this).val();
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: '/sub-categorias-cardapio/listaSubCategoriasCardapio/' + categoria,
                    success: function (data) {
                        $('.subcategoria').empty()
                        $(".subcategoria").attr('required', true);
                        $('.subcategoria').append('<option selected disabled>Selecione uma opção</option>')
                        data.forEach((data) => {
                            $('.subcategoria').append(`<option  value="${data.id}"  class="form-control" id="">${data.nome}</optin>`)
                        })
                    }
                });

            })
        });


    </script>

@endpush
