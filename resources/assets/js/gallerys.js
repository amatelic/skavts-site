/*jshint esnext: true */
import Images from './images/images';
import $ from 'jquery';

(function(window) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
  });
  $('#chooseYear').on('change', e => {
    var year = e.target.value;
    $.ajax({
      method: 'GET',
      url: 'images/year/' + year,
      success: function(res) {
        var articles = $('#articleSection');
        articles.empty();
        res.forEach((article) => {
          articles.append(`<option value=${article.id}>${article.title}</option>`);
        });
      },
    });
  });

  //class for creating, deleting and showing images
  new Images('#articleSection');
})(window);
