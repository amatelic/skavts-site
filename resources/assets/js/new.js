/*jshint esnext: true */
import $ from 'jquery';
(function () {
  class Article {
    constructor(text, url) {
      this.text = text;
      this.url = url;
    }
    shortText(){
      return this.text.substr(0, 10);
    }
  }
  let articles = document.querySelectorAll('article');

  var collection = [];
  var each = function (col, fn) {
    return Array.prototype.forEach.call(col, fn);
  };
    each(articles, function (article) {
      //p elements
      let text = $(article.children[1]);
      let a = article.children[3];
      a.addEventListener('click', function (e) {
        e.preventDefault();
        text.slideToggle();
      });
    });

new Article();

})();
