@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inserir Nots Fiscal</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('notas-fiscais.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <input type="hidden" name="produtosNota" value="[]">
                            <input type="hidden" name="total_nota" id="total_nota">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Fornecedor</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-80" name="fornecedor_id" required>
                                                <option value="" selected>Selecione</option>
                                                @foreach($fornecedores as $f)
                                                    <option value="{{$f->id}}">{{$f->razao_social}}
                                                        - {{$f->cnpj}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Núm. Nota</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control qnt" name="numero_nota"
                                                   value="{{old('numero_nota')}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Natureza</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="natureza" required>
                                                <option value="0">Selecione</option>
                                                <option value="DOAÇÃO">Doação</option>
                                                <option value="CONSIGNAÇÃO">Consignação</option>
                                                <option value="VENDA">Venda</option>
                                                <option value="COMODATO">Comodato</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Valor Frete</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control valor" name="valor_frete"
                                                   value="{{old('valor_frete')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Produto</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="produto_id" id="produto">
                                                <option value="0">Selecione</option>
                                                @foreach($produtos as $p)
                                                    <option value="{{$p->id}}_{{$p->unidade}}_{{$p->nome}}">{{$p->nome}} - {{$p->unidade}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Quant.</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control qnt" name="quantidade" id="quantidade">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Valor Total</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control valor" name="valor" id="valor">
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
                                            <th>Produto</th>
                                            <th>Und.</th>
                                            <th>Quantidade</th>
                                            <th>Valor Unitário</th>
                                            <th>Subtotal</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                        <th colspan="5"><h4>Valor Total</h4></th>
                                        <th><h4 id="total">R$ 0,00 </h4>

                                        </th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2 my-5 btn-salvar">Salvar</button>
                            <a type="button" href="{{route('notas-fiscais.index')}}" class="btn btn-light my-5">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(".btn-salvar").hide();

        var index = 0;
        var subtotal = [];
        var total = 0;
        var produtos_nota = [];
        var data = [];
        $('.btn-add').on('click', function (e) {
            e.preventDefault();
            var dadosProduto = $("#produto option:selected").val().split("_");
            // console.log(dadosProduto)
            // var produto = $("#produto option:selected").text();
            var quantidade = $("#quantidade").val();
            var valor = $("#valor").val();
            var unitario = parseFloat(valor/quantidade).toFixed(2);

            if (dadosProduto !== "") {
                subtotal[index] = parseInt(quantidade) * parseFloat(unitario);
                // subtotal[index] = valor;
                total = parseFloat(total) + parseFloat(subtotal[index]);
                var nota = '<tr scope="row" id="detalhe' + index + '">' +
                    ' <td> <button type="button" class="btn btn-sm btn-danger" onclick="remover(' + index + ');">  <i class="ti-trash"></i> </button></td>  ' +
                    ' <td>' + dadosProduto[2] + '</td>' +
                    ' <td>' + dadosProduto[1] + '</td>' +
                    ' <td>' + quantidade + '</td>' +
                    ' <td>R$ ' + unitario + '</td>' +
                    ' <td>R$ ' + parseFloat(subtotal[index]).toFixed(2) + '</td>' +
                    '</tr>'
                data = {
                    id_produto: dadosProduto[0],
                    quantidade: quantidade,
                    valor_unitario: unitario,
                };
                index++;
                produtos_nota.push(data)
                $("input[name=produtosNota]").val(JSON.stringify(produtos_nota));
                $("#detalhes").append(nota);
                $("#total").html("R$: " + parseFloat(total).toFixed(2));
                $("#total_nota").val(parseFloat(total).toFixed(2));
                $("#produto").val("");
                $("#quantidade").val(0);
                $("#valor").val("");
                ocultar();
            }
        });


        function remover(index) {
            total = total - subtotal[index];
            $("#total").html("R$: " + parseFloat(total).toFixed(2));
            $("#detalhe" + index).remove();
            produtos_nota.splice(produtos_nota.indexOf(index), 1);
            $("input[name=produtosNota]").val(JSON.stringify(produtos_nota));
            $("#total_nota").val(parseFloat(total).toFixed(2));
            ocultar();
        }
        function ocultar(){
            if(total>0){
                $(".btn-salvar").show();
            } else{
                $(".btn-salvar").hide();
            }
        }
    </script>
@endpush
