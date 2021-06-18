const { default: axios } = require("axios");

HomepageShop = {
    modal: $('.modal.home-shop'),

    initialize() {
        this.showSubcategories();
        this.showItemsFromSubcategorie();
    },

    showSubcategories() {
        let buttons = $(this.modal).find('a.nav-link[data-categorie]'),
            shopThis = this;

        buttons.off('click').on('click', function() {
            let categorie = parseInt($(this).data().categorie) || 1;

            if($(this).hasClass('active')) return;

            $(buttons).removeClass('active'),
            $(this).addClass('active');

            axios.get(`/home/category/${categorie}/subcategories`)
                .then(({ data }) => {
                    if(!data.success) {
                        window.toast.show({
                            title: 'Oops',
                            message: data.message,
                            image: '/images/error.gif',
                            position: 'topCenter',
                            imageWidth: 40,
                        });

                        return;
                    }

                    let navSubcategories = $(shopThis.modal).find('.modal-body .nav-subcategories')
                    navSubcategories.html('');

                    data.data.map(e => {
                        navSubcategories.append(`<li class="nav-item" data-subcategorie="${e.id}"><a class="nav-link" href="#"><div class="icon" style="background-image: url('/storage/homepage/icons/${e.icon}')"></div>${e.name}</a></li>`);
                    });
                });
        });
    },

    showItemsFromSubcategorie() {
        let subcategories = '.nav-subcategories li.nav-item[data-subcategorie]',
            boxItems = $(this.modal).find('.items .box-items'),
            shopThis = this;

        $('body').on('click', subcategories, function() {
            let itemHref = $(this).find('a.nav-link'),
                subcategorieId = parseInt($(this).data().subcategorie) || 1;

            if($(itemHref).hasClass('active')) return;

            $(subcategories).find('a.nav-link').removeClass('active'),
            $(itemHref).addClass('active');

            axios.get(`/home/subcategory/${subcategorieId}/products`)
                .then(({data}) => {
                    if(!data.success) {
                        window.toast.show({
                            title: 'Oops',
                            message: data.message,
                            image: '/images/error.gif',
                            position: 'topCenter',
                            imageWidth: 40,
                        });

                        return;
                    }

                    boxItems.html('');

                    data.data.map(item => {
                        boxItems.append(`<div class="item" style="background-image: url('/storage/homepage/${item.category.name}/${item.image}')"></div>`)
                    })
                })
        });
    }
}

$(function() {
    HomepageShop.initialize();
});