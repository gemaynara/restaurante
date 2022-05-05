@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Registrar Saída</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('saidas.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <input type="hidden" name="produtos" value="[]">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Descrição</label>
                                        <div class="col-sm-9">
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="observacao"
                                                       value="{{old('observacao')}}" maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Produto</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single select w-100" name="produto_id"
                                                    id="produto">
                                                <option value="0">Selecione</option>
                                                @foreach($produtos as $p)
                                                    <option
                                                        value="{{$p->id}}_{{$p->unidade}}_{{$p->nome}}_{{$p->estoque}}">{{$p->nome}}
                                                        - {{$p->unidade}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Quant.</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control qnt" name="quantidade"
                                                   id="quantidade">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <button type="button" title="Adicionar" class="btn btn-success btn-icon btn-add">
                                        <i class="ti-plus"></i>
                                    </button>
                                </div>

                                <hr>
                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered" id="detalhes">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>#ID</th>
                                            <th>Produto</th>
                                            <th>Und.</th>
                                            <th>Quantidade</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2 my-5 btn-salvar">Salvar</button>
                            <a type="button" href="{{route('saidas.index')}}" class="btn btn-light my-5">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.select').on('change', function () {
            var produto = $("#produto option:selected").val().split("_");
            ;
            var unidade = produto[1];

            if (unidade === 'KG' || unidade === 'G') {
                $(".qnt").mask("###.###", {reverse: true})
            } else {
                $(".qnt").mask("#####")
            }

        });

        $(".btn-salvar").hide();
        var index = 0;
        var produtos = [];
        var data = [];
        $('.btn-add').on('click', function (e) {
            e.preventDefault();
            var dadosProduto = $("#produto option:selected").val().split("_");
            var quantidade = $("#quantidade").val();
            var estoque = dadosProduto[3];
            var result = produtos.find(element => element.id_produto === dadosProduto[0]);
            if (quantidade <= 0 || dadosProduto === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Verifique os campos e tente novamente'
                });
            }else if(result !== undefined){
                Swal.fire({
                    icon: 'warning',
                    title: 'Produto já existe na lista'
                });
            }else if (parseInt(quantidade) > parseInt(estoque)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Estoque Baixo!',
                    text: 'A quantidade retirada não pode ser superior a quantidade em estoque',
                    footer: 'Estoque disponível: ' + estoque + ' ' + dadosProduto[1]
                });

            } else {
                // if (dadosProduto !== "") {
                var nota = '<tr scope="row" id="detalhe' + index + '">' +
                    ' <td> <button type="button" class="btn btn-sm btn-danger" onclick="remover(' + index + ');">  <i class="ti-trash"></i> </button></td>  ' +
                    ' <td>' + dadosProduto[0] + '</td>' +
                    ' <td>' + dadosProduto[2] + '</td>' +
                    ' <td>' + dadosProduto[1] + '</td>' +
                    ' <td>' + quantidade + '</td>' +
                    '</tr>'
                data = {
                    id_produto: dadosProduto[0],
                    quantidade: quantidade,
                };
                index++;
                produtos.push(data)
                $("input[name=produtos]").val(JSON.stringify(produtos));
                $("#detalhes").append(nota);
                $("#produto").val("");
                $("#quantidade").val(0);
                ocultar();
            }
        });


        function remover(index) {
            $("#detalhe" + index).remove();
            produtos.splice(produtos.indexOf(index), 1);
            $("input[name=produtos]").val(JSON.stringify(produtos));
            ocultar();
        }

        function ocultar() {
            if (index > 0) {
                $(".btn-salvar").show();
            } else {
                $(".btn-salvar").hide();
            }
        }
    </script>
@endpush
