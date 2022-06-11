<div class="modal fade" id="modal-retirada" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Retirada do Caixa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('movimentacao.saida-caixa')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor:</label>
                        <input type="text" class="form-control valor" name="valor_pago" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Identificação:</label>
                        <select class="form-control" name="tipo_identificacao" required>
                            <option value="">Selecione</option>
                            <option value="PAGAMENTO">Pagamentos</option>
                            <option value="OUTROS">Outros</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Descrição:</label>
                        <textarea name="descricao" name="descricao" id="" class="form-control" ></textarea>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>


        </div>
    </div>
</div>
