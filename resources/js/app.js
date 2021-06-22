require('jquery-ui-dist/jquery-ui');
require('./bootstrap');
require('./home/Shop');
require('./home/Homepage');
require('./home/Inventory');

$("body").tooltip({
    selector: '[data-toggle="tooltip"]',
    html: true,
    boundary: 'window'
});