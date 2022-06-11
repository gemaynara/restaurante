<div class="modal fade" id="modal-fechar-caixa" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Fechar Caixa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('caixa.fechar-caixa')}}" method="POST">
                @csrf
                <input type="hidden" name="total_caixa" value="{{isset($caixa)?(($caixa->valor_inicial+$caixa->entradas)- $caixa->saidas): 0}}">
                <input type="hidden" name="saldo_quebra" value="">
                <input type="hidden" name="saldo_falta" value="">
                <input type="hidden" name="id" value="{{isset($caixa->id)? $caixa->id: null}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Saldo Final:</label>
                        <input type="text" class="form-control valor" name="valor_final" required min="1">
                    </div>

                    <div class="form-group" >
                        <label for="recipient-name" class="col-form-label">Totalização do Sistema</label>
                        <h4 class="text-right text-success font-weight-bold">
                            @money(isset($caixa) ? ($caixa->valor_inicial+$caixa->entradas)- $caixa->saidas: 0)</h4>
                    </div>

                    <div class="form-group sobra" style="display:none;">
                        <label for="recipient-name" class="col-form-label">Está Sobrando</label>
                        <h4 class="text-right text-success font-weight-bold valor-sobra"></h4>
                    </div>
                    <div class="form-group falta" style="display:none;">
                        <label for="recipient-name" class="col-form-label">Está Faltando</label>
                        <h4 class="text-right text-danger font-weight-bold valor-falta"></h4>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Observações:</label>
                        <textarea name="observacoes" name="observacoes" id="" class="form-control" ></textarea>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Fechar</button>
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
                var saldo_caixa = $('input[name=total_caixa]').val();
                var saldo_final = $('input[name=valor_final]').val();
                e.preventDefault();

                if (parseFloat(saldo_final) < parseFloat(saldo_caixa)) {
                    falta = parseFloat(saldo_caixa) - parseFloat(saldo_final)
                    $(".falta").css('display', 'block');
                    $(".sobra").css('display', 'none');
                    $(".valor-falta").html(formatMoney(falta))
                    $('input[name=saldo_falta]').val(falta);
                    $('input[name=saldo_quebra]').val(0.00);
                } else if (parseFloat(saldo_final)>  parseFloat(saldo_caixa)){
                    sobra = parseFloat(saldo_final) - parseFloat(saldo_caixa)
                    $(".sobra").css('display', 'block');
                    $(".falta").css('display', 'none');
                    $(".valor-sobra").html(formatMoney(sobra))
                    $('input[name=saldo_quebra]').val(sobra);
                    $('input[name=saldo_falta]').val(0.00);
                }else {
                    $(".falta").css('display', 'none');
                    $(".sobra").css('display', 'none');
                    $('input[name=saldo_quebra]').val(0.00);
                    $('input[name=saldo_falta]').val(0.00);
                }
            });


        })

        function formatMoney(amount) {
            return amount.toLocaleString("pt-BR", {style: "currency", currency: "BRL"});
        }

    </script>
@endpush
