<?php $adicionais = \App\Http\Services\CardapioService::getAdicionaisProduto($p->cardapio->subcategoria_cardapio_id) ?>
<?php $adicionaisPedido = \App\Http\Services\CardapioService::getAdicionaisPedido($p->id, $p->cardapio->subcategoria_cardapio_id) ?>
<div class="modal fade modal-fullscreen-md-down" id="modal-editar-{{$p->id}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Alterar Produto: {{$p->cardapio->nome}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('pedidos.edit-item')}}" method="POST">
                @method('post')
                @csrf
                <input type="hidden" name="numero_pedido" value="{{$pedido->numero_pedido}}">
                <input type="hidden" name="id" value="{{$p->id}}">
                <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                <input type="hidden" name="id_produto" value="{{$p->produto_id}}">
                <input type="hidden" name="valor" value="{{$p->cardapio->valor}}">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="border-bottom text-center pb-3 justify-content-flex-end">
                            <img src="{{asset('imgs/cardapios/'. $p->cardapio->imagem)}}" alt="profile"
                                 class="img-lg  rounded-circle mb-3" width="200px">
                            <div class="mb-3 form-group">
                                <h3>{{$p->cardapio->nome}}</h3>
                                <h4>@money($p->cardapio->valor)</h4>
                                <p>{{$p->cardapio->descricao}} </p>
                            </div>

                            <div class="form-group mx-auto col-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend btn-minus-{{$p->id}}">
                                        <span class="input-group-text btn-success text-white ">-</span>
                                    </div>
                                    <input type="text" class="form-control qnt" style="text-align: center!important;"
                                           name="quantidade"
                                           placeholder="Insira a quantidade" value="{{$p->quantidade}}">
                                    <div class="input-group-prepend btn-plus-{{$p->id}}">
                                        <span class="input-group-text btn-success text-white ">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($adicionais) > 0)
                            <div class="row mt-2">
                                <div class="col-md-6 center-center mx-auto">
                                    <h6>Adicionais</h6>
                                    <div class="form-group">
                                        @foreach($adicionais as $key=>$adc)
                                            <label class="list-group-item d-flex gap-2">
                                                <input class="form-check-input flex-shrink-0"
                                                       type="checkbox"
                                                       {{isset($adicionaisPedido[$adc->id]) && $adicionaisPedido[$adc->id]  == $adc->id ? 'checked': ''}}
                                                       value="{{$adc->id}}_{{$adc->valor}}" name="adicionais[]">
                                                <span>{{$adc->nome}} - @money($adc->valor)</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row mt-2  ">
                            <div class="form-group center-center mx-auto">
                                <label for="exampleTextarea1">Observações</label>
                                <textarea class="form-control" name="observacoes" rows="2" maxlength="200">{{$pedido->observacoes}}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Alterar</button>
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
