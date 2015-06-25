'use strict';

var assign = require('lodash/object/assign');
var envConfig = require('./config.env');

module.exports = assign({
  app: {
    title: 'localBooking - book something nice for you!'
  }
}, envConfig);
