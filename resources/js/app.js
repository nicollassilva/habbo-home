require('jquery-ui-dist/jquery-ui');
require('./bootstrap');
require('./home/Homepage');
require('./home/Shop');

$("body").tooltip({
    selector: '[data-toggle="tooltip"]',
    html: true,
    boundary: 'window'
});