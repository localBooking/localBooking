'use strict';

var m = require('mithril');
var config = require('../config');

function loadArticles () {
  return [
    { name: 'Meeting' },
    { name: 'Desk' },
    { name: 'Event' },
  ];
}

function articleView (article) {
  return m('.article', article.name);
}

module.exports = {
  controller: function () {
    var scope = {
      articles: loadArticles()
    };
    return scope;
  },
  view: function (scope) {
    return m('.overview', [
      m('h1', config.app.title),
      scope.articles.map(articleView)
    ]);
  }
};
