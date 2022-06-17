<?php $adicionais = \App\Http\Services\CardapioService::getAdicionaisProduto($p->subcategoria_cardapio_id) ?>
<div class="modal fade" id="modal-produto-{{$p->id}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Inserir Item no Pedido</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('pedidos.add-item')}}" method="POST" class="forms-sample">
                @method('post')
                @csrf
                <input type="hidden" name="numero_pedido" value="{{$pedido->numero_pedido}}">
                <input type="hidden" name="id_produto" value="{{$p->id}}">
                <input type="hidden" name="valor" value="{{$p->valor}}">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="border-bottom text-center pb-3 justify-content-flex-end">
                            <img src="{{asset('imgs/cardapios/'. $p->imagem)}}" alt="profile"
                                 class="img-lg  rounded-circle mb-3" width="200px">
                            <div class="mb-3 form-group">
                                <h3>{{$p->nome}}</h3>
                                <h4>@money($p->valor)</h4>
                                <p>{{$p->descricao}} </p>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend btn-minus-{{$p->id}}">
                                        <span class="input-group-text btn-success text-white ">-</span>
                                    </div>
                                    <input type="text" class="form-control qnt" style="text-align: center!important;"
                                           name="quantidade"
                                           placeholder="Insira a quantidade" value="1">
                                    <div class="input-group-prepend btn-plus-{{$p->id}}">
                                        <span class="input-group-text btn-success text-white ">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($adicionais) > 0)
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <h6>Adicionais</h6>
                                    <div class="form-group">
                                        @foreach($adicionais as $key=> $adc)
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           value="{{$adc->id}}_{{$adc->valor}}" name="adicionais[]">
                                                    {{$adc->nome}} - @money($adc->valor)
                                                    <i class="input-helper"></i></label>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row mt-2">
                            <div class="form-group">
                                <label for="exampleTextarea1">Observações</label>
                                <textarea class="form-control" name="observacoes" rows="2" maxlength="200"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>


        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(".btn-minus-{{$p->id}}").on('click', function (e) {
            e.preventDefault();
            var qnt = $(".qnt").val();
            if (qnt > 1) {
                qnt = parseInt(qnt) - 1;
                $(".qnt").val(qnt);
            } else {
                $(".qnt").val(1);
            }
        })

        $(".btn-plus-{{$p->id}}").on('click', function (e) {
            e.preventDefault();
            var qnt = $(".qnt").val();
            if (qnt >= 1) {
                qnt = parseInt(qnt) + 1;
                $(".qnt").val(qnt);
            } else {
                $(".qnt").val(1);
            }
        })
    </script>
@endpush
