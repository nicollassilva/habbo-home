@extends('layouts.app')

@section('title', 'Página inicial')

@section('content')
<div class="row full-row">
    <form method="POST" class="form-signin text-center" action="{{ route('register') }}" autocomplete="off">
        @csrf

        <div class="logo"></div>
        <h1 class="h4 my-3 font-weight-normal">Registre-se</h1>

        <div class="form-group mb-0">
            <input id="username" type="text" class="form-control border-bottom-0 rounded-0 @error('username') is-invalid @enderror" name="username"
                value="{{ old('username') }}" placeholder="Seu username" autofocus>

            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group mb-0">
            <input id="email" type="email" class="form-control border-bottom-0 rounded-0 @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="Seu email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group mb-0">
            <input id="password" type="password" placeholder="Sua senha" class="form-control border-bottom-0 rounded-0 mb-0 @error('password') is-invalid @enderror"
                name="password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group mb-0">
            <input id="password-confirm" type="password" placeholder="Confirme sua senha" class="form-control rounded-0 @error('password-confirm') is-invalid @enderror"
                name="password_confirmation">

            @error('password-confirm')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="name" type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" placeholder="Seu nome" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group mb-0">
            <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
            <a href="{{ route('login') }}" class="btn btn-lg btn-danger mt-1 btn-block" type="button"><i class="fas fa-chevron-left mr-2"></i>Voltar</a>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; Developed by <a href="https://github.com/nicollassilva/">Nícollas Silva</a></p>
    </form>
</div>
@endsection