'use strict';

var m = require('mithril');

m.route.mode = 'hash';
m.route(global.document.getElementById('app'), '/', {
  '/': require('./catalog/overview'),
  /*
  '/meeting': require('./catalog/meeting'),
  '/desk': require('./catalog/desk'),
  '/event': require('./catalog/event'),
  '/cart': require('./checkout/cart'),
  '/book': require('./checkout/book')
  */
});
