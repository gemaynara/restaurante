@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inserir novo Usuário</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('users.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nome</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name"
                                                   value="{{old('name')}}"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Usuário</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="username"
                                                   value="{{old('username')}}"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">E-mail</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email"
                                                   value="{{old('email')}}" required>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Senha</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password"
                                                   value="{{old('password')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Repita a senha</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="confirm_password">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Empresa</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 " name="empresa_id" required>
                                                <option>Selecione</option>
                                                @foreach($empresas as $value)
                                                    <option value="{{$value->id}}">{{$value->razao_social}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Perfil de Acesso</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-multiple w-100 "
                                                    multiple name="roles[]">
                                                <option>Selecione</option>
                                                @foreach($roles as $key=>$value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            <a  href="{{route('users.index')}}" class="btn btn-light">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
