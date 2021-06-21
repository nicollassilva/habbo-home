Inventory = {
    modal: $('.modal.home-inventory'),

    initialize() {
        this.itemsFromCategory();
    },

    itemsFromCategory() {
        let buttons = $(this.modal).find('a.nav-link[data-categorie]');

        buttons.off('click').on('click', function() {
            let categorie = parseInt($(this).data().categorie) || 1;

            if($(this).hasClass('active')) return;

            $(buttons).removeClass('active'),
            $(this).addClass('active');

            axios.get(`/home/category/${categorie}/items/show`)
                .then(({data}) => {
                    console.log(data)
                });
        })
    }
}

$(function() {
    Inventory.initialize();
});