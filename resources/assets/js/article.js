/*jshint esnext: true */
import $ from 'jquery';
import ArticleTable from './article/articleModal';
(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
  });

  var tbody = $('.artilceBody');
  var article = new ArticleTable(tbody, '#myModal');

})();
