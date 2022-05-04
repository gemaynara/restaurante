@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Editar Empresa</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('empresas.update', $empresa->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nome/ Razão Social</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="razao_social"
                                                   value="{{$empresa->razao_social}}"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">CNPJ</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control cnpj" name="cnpj"
                                                   value="{{$empresa->cnpj}}" required>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">CEP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control cep" name="cep" id="cep"
                                                   value="{{$empresa->cep}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Endereço</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="endereco" id="endereco"
                                                   value="{{$empresa->endereco}}" maxlength="200">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">E-mail</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email"
                                                   value="{{$empresa->email}}"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Telefone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control telefone" name="telefone"
                                                   value="{{$empresa->telefone}}" maxlength="19">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Bairro</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="bairro"
                                                   value="{{$empresa->bairro}}" maxlength="100" id="bairro">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Cidade</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cidade" id="cidade"
                                                   value="{{$empresa->cidade}}" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Estado</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="estado"
                                                   value="{{$empresa->estado}}" maxlength="2" id="estado">
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            <a href="{{route('empresas.index')}}" class="btn btn-light">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
