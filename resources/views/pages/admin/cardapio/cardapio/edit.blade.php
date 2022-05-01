@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Editar Registro</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('cardapios.update', $cardapio->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nome</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nome"
                                                   value="{{$cardapio->nome}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Valor</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control valor" name="valor"
                                                   value="{{$cardapio->valor}}" required>
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
                                                    <option
                                                        value="{{$list->id}}" {{$cardapio->setor_id == $list->id ? 'selected': ''}}>{{$list->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Categoria</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="categoria_cardapio_id" id="categoria"
                                                    required>
                                                <option value="">Selecione</option>
                                                @foreach($categorias as $list)
                                                    <option value="{{$list->id}}"
                                                   {{$cardapio->categoria_cardapio_id == $list->id ? 'selected': ''}} >{{$list->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Sub Categoria</label>
                                        <div class="col-sm-9">
                                            <select class="form-control subcategoria" name="subcategoria_cardapio_id"
                                                    id="subcategoria_id" required>
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
                                            <input type="time" class="form-control " name="tempo_preparo"
                                                   value="{{$cardapio->tempo_preparo}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Und. Medida</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control " name="medida"
                                                   value="{{$cardapio->medida}}" required maxlength="10">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Núm Porções</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control qnt" name="quantidade_servida"
                                                   value="{{$cardapio->quantidade_servida}}" maxlength="5">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Descrição</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="descricao">{{$cardapio->descricao}}"</textarea>
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
                                            <img src="{{asset('imgs/cardapios/'. $cardapio->imagem)}}" alt="" id="img" width="300px">
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
        var subcategoria_id = @json($cardapio->subcategoria_cardapio_id);
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

        $(document).ready(function () {
            var categoria = $('#categoria').val();
            if (categoria != 0) {
                $.ajax({
                    type: 'GET',
                    cache: false,
                    url: '/sub-categorias-cardapio/listaSubCategoriasCardapio/' + categoria,
                    success: function (data) {
                        $('.subcategoria').empty()
                        $(".subcategoria").attr('required', true);
                        $('.subcategoria').append('<option selected disabled>Selecione uma opção</option>')
                        data.forEach((data) => {
                            $('.subcategoria').append(`<option name="subcategoria_id" ${data.id == subcategoria_id ? "selected" : ''} value="${data.id}"  class="form-control" id="">${data.nome}</optin>`)
                        })
                    }
                });
            }
        });

    </script>

@endpush
