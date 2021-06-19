<div class="modal home-shop fade" id="shopModal" tabindex="-1" role="dialog" aria-labelledby="shopModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-secondary d-flex justify-content-around">
                    <div class="col col-3">
                        <h5 class="modal-title" id="shopModalLabel">Loja de Widgets</h5>
                    </div>
                    <div class="col col-7 h-100">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link" data-categorie="5">Principal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-categorie="1">Backgrounds</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-categorie="2">Stickers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-categorie="4">Widgets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" tabindex="-1" aria-disabled="true">Notas</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col col-2 d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            </div>
            <div class="modal-body d-flex justify-content-around">
                <div class="col-3 col-xl-2 subcategories">
                    <ul class="nav nav-subcategories flex-column"></ul>
                </div>
                <div class="col-9 col-xl-10 items">
                    <div class="col-12 bg-secondary box-item-actions" style="display: none">
                        <div class="item-preview"></div>
                        <span class="title mb-2"></span>
                        <button class="btn btn-dark mt-3 d-block">Price: <b></b></button>
                        <input type="number" min="1" max="255" value="1" id="quantity" class="btn btn-dark d-block mt-3">
                        <button class="btn btn-success mt-3 btn-lg buy-item">Comprar</button>
                        <button class="btn btn-primary mt-3 btn-lg">Presentear</button>
                    </div>
                    <div class="col-12 box-items p-0"></div>
                </div>
            </div>
        </div>
    </div>
</div>