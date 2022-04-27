@extends('auth.template')

@section('content')
    <div class="col-lg-4 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
                {{--                            <img src="../../images/logo.svg" alt="logo">--}}
            </div>
            <h4>Olá!</h4>
            <h6 class="fw-light">Insiras suas credenciais para iniciar.</h6>
            <form class="pt-3" method="POST" action="{{ route('auth.post-login') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror"
                           name="username" value="{{ old('username') }}"
                           placeholder="Usuário">
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                           name="password"
                           placeholder="Senha">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                        ENTRAR
                    </button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        {{--                                    <label class="form-check-label text-muted">--}}
                        {{--                                        <input type="checkbox" class="form-check-input">--}}
                        {{--                                        Keep me signed in--}}
                        {{--                                    </label>--}}
                    </div>
                    <a href="#" class="auth-link text-black">Esqueci minha senha</a>
                </div>

                {{--                            <div class="text-center mt-4 fw-light">--}}
                {{--                                Don't have an account? <a href="register.html" class="text-primary">Create</a>--}}
                {{--                            </div>--}}
            </form>
        </div>
    </div>


@endsection
