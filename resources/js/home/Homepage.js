Homepage = {
    initialize() {
        this.initDraggable();
        this.reload();
    },

    initDraggable() {
		$('.playground .in-draggable').draggable({
            containment:'.playground',
            cursor: 'move'
        });
        
        this.initZAxis();
        //this.deleteItem();
        //this.changeTheme();
        this.reverse();
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
            $.map($('.in-draggable'), event => {
              if ($(event).css('position') != 'static') {
                  return parseInt($(event).css('z-index')) || 1;
              }
        }));
    },

    initZAxis() {
        let highestIndex = this.getHighestZIndexOnPage();

        document.querySelectorAll('.in-draggable').forEach(function(event) {
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
	}
}

$(function() {
    Homepage.initialize();
});