@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Editar  perfil</h4>
                        @include('layouts.partials.alerts')
                        <form class="forms-sample" method="post" action="{{route('roles.update', $role->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nome</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name"
                                                   value="{{$role->name}}"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Permissão</label>
                                        <div class="col-sm-9">
                                            @foreach($permission as $value)
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ $value->name }}</label>
                                                <br/>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            <a  href="{{route('roles.index')}}" class="btn btn-light">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
