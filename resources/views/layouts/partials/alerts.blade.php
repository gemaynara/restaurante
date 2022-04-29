@if ( count( $errors ) > 0 )
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <span>  {!! ucfirst($error) !!}</span>
        </div>

    @endforeach

@endif


@if (session('info'))
    <div class="alert alert-info" role="alert">
        <span>   {!! ucfirst(session('info')) !!}</span>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" role="alert">
        <span>   {!! ucfirst(session('error')) !!}</span>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        <span> {{ session()->get('success') }}</span>
    </div>
@endif


@if (session('warning'))

    <div class="alert alert-warning" role="alert">
        <span> {!! ucfirst(session('warning')) !!}</span>
    </div>

@endif



