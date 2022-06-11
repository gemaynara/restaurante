<div class="modal fade" id="modal-pagamento" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Pagamento de Pedido</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('movimentacao.pagamento-pedido')}}" method="POST">
                @csrf
                <input type="hidden" name="identificador" value="{{$pedido->id}}">
                <input type="hidden" name="pedido" value="{{$pedido->numero_pedido}}">
                <input type="hidden" name="tipo_identificacao" value="PEDIDO">
                <input type="hidden" name="valor_total" value="{{$pedido->total}}">
                <input type="hidden" name="saldo_pago" value="{{$saldo_pago}}">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor:</label>
                        <input type="text" class="form-control valor" name="valor_pago" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Forma de Pagamento:</label>
                        <select class="form-control" name="forma_pagamento" required>
                            <option value="">Selecione</option>
                            <option value="Cartão Crédito">Cartão de Crédito</option>
                            <option value="Cartão Débito">Cartão de Débito</option>
                            <option value="Dinheiro">Dinheiro</option>
                        </select>
                    </div>

                    <div class="form-group troco" style="display: none">
                        <label for="recipient-name" class="col-form-label">Troco</label>
                        <h4 class="text-right text-success font-weight-bold mb-5 valor_troco"></h4>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Pagar</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>


        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $(".valor").on('keyup', function (e) {
                var troco = 0.00;
                var valor_total = $('input[name=valor_total]').val();
                var recebido = $('input[name=valor_pago]').val();
                var pago = $('input[name=saldo_pago]').val();
                e.preventDefault();

                if ((parseFloat(recebido) + parseFloat(pago)) > parseFloat(valor_total)) {
                    troco = (parseFloat(recebido) + parseFloat(pago)) - parseFloat(valor_total)
                    $(".troco").css('display', 'block');
                    $(".valor_troco").html(formatMoney(troco))
                // }
                // if (parseFloat(recebido) > parseFloat(pago)) {
                //     troco = parseFloat(recebido) - parseFloat(pago)
                //     $(".troco").css('display', 'block');
                //     $(".valor_troco").html(formatMoney(troco))
                } else {
                    $(".troco").css('display', 'none');
                }
            });


        })

        function formatMoney(amount) {
            return amount.toLocaleString("pt-BR", {style: "currency", currency: "BRL"});
        }
    </script>
@endpush
