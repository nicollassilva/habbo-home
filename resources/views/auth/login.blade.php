@extends('layouts.app')

@section('title', 'Página inicial')

@section('content')
<div class="row full-row">
    <form method="POST" class="form-signin text-center" action="{{ route('login') }}" autocomplete="off">
        @csrf

        <div class="logo"></div>
        <h1 class="h4 my-3 font-weight-normal">Acesse agora!</h1>
        <div class="form-group mb-0">
            <input id="username" type="text" class="form-control rounded-0 border-bottom-0 @error('username') is-invalid @enderror" name="username"
                value="{{ old('username') }}" placeholder="Seu username" autofocus>

            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password" placeholder="Sua senha" class="form-control rounded-0 @error('password') is-invalid @enderror"
                name="password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group mb-0">
            <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
            <a href="{{ route('register') }}" class="btn btn-lg btn-primary mt-1 btn-block" type="button">Fazer cadastro</a>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; Developed by <a href="https://github.com/nicollassilva/">Nícollas Silva</a></p>
    </form>
</div>
@endsection