Inventory = {
    modal: $('.modal.home-inventory'),

    initialize() {
        this.showItemsByCategory();
    },

    showItemsByCategory() {
        let buttons = $(this.modal).find('a.nav-link[data-categorie]'),
            boxItems = $(this.modal).find('.items .box-items');

        buttons.off('click').on('click', function() {
            let categorie = parseInt($(this).data().categorie) || 1,
                categorieName = $(this).html().toString().toLowerCase();

            if($(this).hasClass('active')) return;

            axios.get(`/home/category/${categorie}/items/show`)
                .then(({data}) => {
                    if(data.data.length <= 0) {
                        iziToast.show({
                            title: 'Oops',
                            message: 'Nenhum item encontrado, você permanecerá na página anterior.',
                            image: '/images/error.gif',
                            progressBarColor: 'rgba(255, 94, 87,1.0)',
                            imageWidth: 40,
                        });

                        return;
                    }

                    $(buttons).removeClass('active'),
                    $(this).addClass('active');
                    boxItems.html('');

                    data.data.map(item => {
                        boxItems.append(`<div class="item" data-name="${item.product.title}" data-id="${item.product.id}" style="background-image: url('/storage/homepage/${categorieName}/${item.product.image}')"></div>`)
                    });

                    boxItems.find('.item:first-of-type').trigger('click');
                });
        })
    }
}

$(function() {
    Inventory.initialize();
});