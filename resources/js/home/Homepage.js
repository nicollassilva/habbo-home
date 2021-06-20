const { default: axios } = require("axios");

Homepage = {
    playground: $('.box-home .playground'),
    themes: ["golden_skin", "default_skin", "bubble_skin", "metal_skin", "notepad_skin", "note_skin", "hcm_skin"],

    initialize() {
        if(window.location.pathname != '/home/index') {
            return;
        }

        this.initDraggable();
        this.saveItems();
        //this.reload();
    },

    initDraggable() {
        if(window.location.pathname != '/home/index') {
            return;
        }
        
		$('.playground .in-draggable').draggable({
            containment:'.playground',
            cursor: 'move'
        });
        
        $('.playground .in-draggable-widget').draggable({
            containment:'.playground',
            cursor: 'move',
            handle: '.heading'
        });

        this.initZAxis();
        //this.deleteItem();
        this.changeTheme();
        this.reverse();
	},

    changeTheme() {
        let dropdownClass = '.box-home .playground .widget .btns-actions button[dataPreferences]',
            themeClass = '.box-home .playground .widget .btns-actions .themes li',
            shopThis = this;

        $(dropdownClass).off('click').on('click', function() {
    		$(this).prev().slideToggle();
		});

        $(themeClass).off("click").on('click', function() {
			let nextTheme = $(this).attr('data-content'),
				currentWidget = $(this).parent().parent().parent().parent(),
                currentTheme = currentWidget.attr('data-theme');

            if(currentTheme != nextTheme && shopThis.themes.includes(nextTheme)) {
                currentWidget.fadeOut('fast', function() {
                    currentWidget.removeClass(`widget_${currentTheme}`).addClass(`widget_${nextTheme}`).attr('data-theme', nextTheme)
                    currentWidget.fadeIn();
                });
            }
        });
    },

    reverse() {
		$('.box-home .playground .sticker .btns-actions button:first-of-type').off('click').on('click', function() {
			let sticker = $(this).parent().parent(),
				attr = sticker.attr('reverse');

            sticker.attr('reverse', `${attr == '0' ? '1' : '0'}`)
		})
	},

    getHighestZIndexOnPage() {
        return Math.max.apply(null, 
            $.map($('.in-draggable, .in-draggable-widget'), event => {
              if ($(event).css('position') != 'static') {
                  return parseInt($(event).css('z-index')) || 1;
              }
        }));
    },

    initZAxis() {
        let highestIndex = this.getHighestZIndexOnPage();

        document.querySelectorAll('.in-draggable, .in-draggable-widget').forEach(function(event) {
            event.addEventListener('dblclick', function() {
                $(this).css('zIndex', highestIndex++);
            });
        });
	},

    reload: function() {
		$(document).on('keydown', e => {
			if((e.which || e.keyCode) == 116) {
				e.preventDefault();
				window.toast.show({
					title: 'Hey',
					image: '/images/error.gif',
                    position: 'topCenter',
					imageWidth: 40,
					progressBar: false,
					timeout: false,
					message: 'Recomendamos que você salve antes de atualizar.',
					buttons: [
						['<button>Atualizar</button>', (instance, toast) => {
							document.location.reload()
						}, true],
						['<button>Vou salvar!</button>', (instance, toast) => {
							instance.hide({
								transitionOut: 'fadeOutUp'
							}, toast, 'buttonName');
						}]
					]
				})
			}
		})
	},

    saveItems() {
        $('.box-home .header button[dataSave]').one('click', () => {
            let items = [];

            $('.box-home .playground .in-draggable, .box-home .playground .in-draggable-widget').each(function(a, e) {
				const itemId = Number($(e).attr('class').split(' ')[2].replace('itemid', '')),
					widgetId = Number($(e).attr('class').split(' ')[3].replace('widget-', '')),
					top = Number($(e).css("top").replace(/[px||rem||cm]/gi, '')),
					left = Number($(e).css("left").replace(/[px||rem||cm]/gi, '')),
					zIndex = $(e).css("z-index") != 'auto' ? Number($(e).css("z-index")) : 1,
					reverse = $(e).hasClass('in-draggable-widget') ? 0 : (Number($(e).attr('reverse')) ?? 0),
                    theme = $(e).hasClass('in-draggable-widget') ? $(e).attr('data-theme') ?? 'default_skin' : null;

				items[a] = { 
                    item_id: itemId,
                    widget_id: widgetId,
                    y: top,
                    x: left,
                    z: zIndex,
                    reverse,
                    theme
                };
			});

            axios.put('/home/items/update', {
                items: JSON.stringify(items)
            }).then(({data}) => {
                if(!data.success) {
                    iziToast.show({
                        title: 'Oops',
                        message: data.message,
                        image: '/images/error.gif',
                        progressBarColor: 'rgba(255, 94, 87,1.0)',
                        imageWidth: 40,
                    });

                    return;
                }

                iziToast.show({
                    title: 'Yeah!',
                    message: data.message,
                    image: '/images/success.gif',
                    progressBarColor: 'rgba(68, 189, 50, 1.0)',
                    imageWidth: 56
                });

                setTimeout(_ => window.location = '/home/index', 1000);
            })
        });
    }
}

$(function() {
    Homepage.initialize();
});