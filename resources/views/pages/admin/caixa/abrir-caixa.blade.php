<div class="modal fade" id="modal-abrir-caixa" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Abrir Caixa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('caixa.abrir-caixa')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Saldo Inicial:</label>
                        <input type="text" class="form-control valor" name="valor_inicial" required min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Abrir</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>


        </div>
    </div>
</div>
