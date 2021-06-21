require('./bootstrap');
require('./home/Shop');
require('./home/Homepage');
require('./home/Inventory');
require('jquery-ui-dist/jquery-ui');

$("body").tooltip({
    selector: '[data-toggle="tooltip"]',
    html: true,
    boundary: 'window'
});