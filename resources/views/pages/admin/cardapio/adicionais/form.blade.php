<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Inserir Adicional para: {{$subcategoria->nome}}</h4>
                @include('layouts.partials.alerts')
                <form class="forms-sample" method="post" action="{{route('adicionais.store')}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <input type="hidden" name="subcategoria_cardapio_id" value="{{$subcategoria->id}}">
                    <input type="hidden" name="id" value="{{isset($adicional)? $adicional->id : null}}">
                    <div class="form-group">
                        <label for="exampleInputName1">Nome</label>
                        <input type="text" class="form-control" name="nome" required value="{{isset($adicional)? $adicional->nome : old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Valor</label>
                        <input type="text" class="form-control valor" name="valor" required value="{{isset($adicional)? $adicional->valor : old('valor')}}">
                    </div>


                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                    <a class="btn btn-light" type="button" href="{{route('sub-categorias-cardapio.index')}}">Voltar</a>
                </form>
            </div>
        </div>
    </div>

</div>
