@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    <img src="{{asset('images/no-picture.jpg')}}" alt="profile"
                                         class="img-lg rounded-circle mb-3">
                                    <div class="mb-3">
                                        <h3>{{$user->name}}</h3>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h5 class="mb-0 me-2 text-muted">{{$user->username}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-bottom py-4">
                                    <p>Perfil</p>
                                    <div>
                                        @foreach($roles as $role)
                                            <label class="badge badge-outline-success mb-2">{{$role}}</label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="border-bottom py-4">
                                    <p>Permissões</p>
                                    <div>
                                        @foreach($permissions as $p)
                                            <label class="badge badge-outline-dark mb-2">Controle
                                                de {{ucfirst($p->name)}}</label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="py-4">
                                    <p class="clearfix">
                          <span class="float-left">
                            Status
                          </span>
                                        <span class="float-right text-muted">
                           {{$user->active == 1? 'Ativo': 'Inativo'}}
                          </span>
                                    </p>

                                    <p class="clearfix">
                          <span class="float-left">
                           E-mail
                          </span>
                                        <span class="float-right text-muted">
                            {{$user->email}}
                          </span>
                                    </p>
                                    <p class="clearfix">
                          <span class="float-left">
                            Data Cadastro
                          </span>
                                        <span class="float-right text-muted">
                           {{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}
                          </span>
                                    </p>

                                </div>

                            </div>
                            <div class="col-lg-8">
                                <h4 class="card-title">Alterar Senha</h4>
                                @include('layouts.partials.alerts')
                                <div class="mt-4 py-2 border-top border-bottom">

                                    <form class="forms-sample" method="post" action="{{route('profile.update')}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="form-group">
                                            <label for="exampleInputName1">Senha Atual</label>
                                            <input type="password" class="form-control " name="current-password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Nova Senha </label>
                                            <input type="password" class="form-control" name="new-password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Repita a Senha</label>
                                            <input type="password" class="form-control" name="new-password_confirmation" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary me-2">Alterar</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
