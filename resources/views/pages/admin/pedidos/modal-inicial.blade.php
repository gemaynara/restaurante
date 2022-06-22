<div class="modal fade" id="modal-mesa-{{$mesa->id}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Abrir Comanda - Mesa {{$mesa->codigo}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('pedidos.abrir-comanda')}}" method="POST">
                @csrf
                <input type="hidden" name="mesa_id" value="{{$mesa->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome do Cliente (Opcional):</label>
                        <input type="text" class="form-control" name="nome" maxlength="50">
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Número de Pessoas na Mesa:</label>
                        <input type="text" class="form-control qnt" name="numero_pessoas" required min="1">
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
