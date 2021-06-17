@extends('includes.app')

@section('title', 'Página inicial')

@section('content')
<div class="row full-row">
    <form action="/users" class="form-signin text-center" method="POST" autocomplete="off">
        <div class="logo"></div>
        <h1 class="h4 my-3 font-weight-normal">Acesse agora!</h1>
        <div class="form-group">
            <label for="input-username" class="sr-only">Username</label>
            <input type="text" name="username" id="input-username" class="form-control" placeholder="Nome de Usuário" autofocus>
        </div>
        <div class="form-group">
            <label for="input-password" class="sr-only">Senha</label>
            <input type="password" name="password" id="input-password" class="form-control" placeholder="Senha">
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
        <a href="/users/create" class="btn btn-lg btn-primary mt-1 btn-block" type="button">Fazer cadastro</a>
        <p class="mt-5 mb-3 text-muted">&copy; Developed by <a href="https://github.com/nicollassilva/">Nícollas Silva</a></p>
    </form>
</div>
@endsection