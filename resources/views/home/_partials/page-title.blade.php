<div class="jumbotron w-100 text-secondary">
    @if (Route::current()->getName() === 'home.index')
    <h1 class="display-5"><i class="fas fa-file-alt mr-2"></i>Minha Habbo Home</h1>
    @else
    <h1 class="display-5"><i class="fas fa-file-alt mr-2"></i>Habbo Home</h1>
    <p class="lead">Exibindo a página de <b>{{ $user->username ?? 'Anônimo' }}</b></p>
    @endif
    <hr class="my-4">
    <form action="" autocomplete="off" method="POST">
        <div class="row">
            <div class="col col-10">
                <input type="text" class="form-control" name="user" placeholder="Pesquise home de outro usuário...">
            </div>
            <div class="col col-2">
                <button class="btn btn-success btn-sm w-100" style="height: 37px" type="submit">Pesquisar</button>
            </div>
        </div>
    </form>
</div>