@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inserir Produto</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('produtos.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nome</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nome" value="{{old('nome')}}"
                                                   required>
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
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Categoria</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="categoria_produto_id"
                                                    required>
                                                <option value="">Selecione</option>
                                                @foreach($categorias as $list)
                                                    <option value="{{$list->id}}">{{$list->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Qnt. Estoque</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control qnt" name="estoque"
                                                   value="{{old('estoque')}}" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Und. Medida</label>
                                        <div class="col-sm-9">
                                            <select name="unidade" id="und" class="form-control" required>
                                                <option>Selecione</option>
                                                @foreach($medidas as $medida)
                                                    <option value="{{$medida['key']}}">{{$medida['value']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Lote</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control qnt" name="lote"
                                                   value="{{old('lote')}}" maxlength="20">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Estoque Min.</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control qnt" name="estoque_min"
                                                   value="{{old('estoque_min')}}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Estoque Máx.</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control qnt" name="estoque_max"
                                                   value="{{old('estoque_max')}}" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Descrição</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control"
                                                      name="descricao">{{old('descricao')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            <a class="btn btn-light" href="{{route('produtos.index')}}">Cancelar</a>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function (e) {
            $('#und').on('change', function () {
                var unidade = $("#und option:selected").val();
                if (unidade === 'KG' || unidade === 'G') {
                    $(".qnt").mask("###.###", {reverse: true})
                } else {
                    $(".qnt").mask("#####")
                }

            });
        })

    </script>
@endpush
