const { default: axios } = require("axios");

HomepageShop = {
    modal: $('.modal.home-shop'),
    currentItem: null,

    initialize() {
        this.showSubcategories();
        this.showItemsFromSubcategorie();
        this.showItemWhenClick();
        this.buyItem();
    },

    showSubcategories() {
        let buttons = $(this.modal).find('a.nav-link[data-categorie]'),
            shopThis = this;

        buttons.off('click').on('click', function() {
            let categorie = parseInt($(this).data().categorie) || 1;

            shopThis.toggleBoxItem('none');

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
                        navSubcategories.append(`<li class="nav-item" data-subcategorie="${e.id}"><a class="nav-link"><div class="icon" style="background-image: url('/storage/homepage/icons/${e.icon}')"></div>${e.name}</a></li>`);
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
                        boxItems.append(`<div class="item" data-name="${item.title}" data-price="${item.value}" data-id="${item.id}" style="background-image: url('/storage/homepage/${item.category.name}/${item.image}')"></div>`)
                    });

                    shopThis.toggleBoxItem('block');
                    shopThis.clearItemPreview();
                    boxItems.find('.item:first-of-type').trigger("click").addClass('active');
                })
        });
    },

    toggleBoxItem(value) {
        if(value === 'none') {
            $('.box-item-actions, .box-items').fadeOut('slow');
            return;
        }

        $('.box-item-actions').fadeIn('slow'); 
        $('.box-items').css('display', value != 'block' ? value : 'flex'); 
    },

    clearItemPreview() {
        $('.box-item-actions .item-preview').removeAttr('style');
        $('.box-item-actions span.title').html('');
    },

    showItemWhenClick() {
        let itemClass = '.modal.home-shop .modal-body .items .item',
            boxPreview = '.box-item-actions .item-preview',
            shopThis = this;

        $('body').on('click', itemClass, function() {
            let title = $(this).data().name,
                price = parseInt($(this).data().price) || 1,
                id = parseInt($(this).data().id) || 1;

            shopThis.currentItem = id;

            $(boxPreview).attr('style', $(this).attr('style'));
            $('.box-item-actions span.title').html(title);
            $('.box-item-actions button:first-of-type b').html(price);
            $('.box-item-actions input#quantity').val(1)
            
            $(itemClass).removeClass('active');
            $(this).addClass('active');
        })
    },

    buyItem() {
        $('body').on('click', '.box-item-actions button.buy-item', _ => {
            if(!this.currentItem) return;

            console.log(this.currentItem)
        });
    }
}

$(function() {
    HomepageShop.initialize();
});