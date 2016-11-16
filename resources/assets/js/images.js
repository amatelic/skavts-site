/*jshint esnext: true */
import Images from './images/images';
import $ from 'jquery';

(function(window) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
  });

  function displayImages(index, img) {
    let image = $(img);
    setTimeout(function() {
      image.addClass('skavt-post-image-animation');
    }, (index + 1) * 200);

  }
  var currentYear = new Date().getFullYear() - 1;
  var loadButton = $('.load-images');
  $('.skavt-post-image').each(displayImages);

  loadButton.on('click', ajaxCall);

  function template(collection, year) {
    let template = `<h3>Leto ${year}</h3><div class='skavt-gallery'>`;
    collection.forEach((collection) => {
      template += `<a href='${collection}' data-lightbox='image-1' data-title='skavt-post'>
    <img class='skavt-post-image' src='${collection}'></a>`;

    });
    return template += `</div>`;
  }

  function ajaxCall() {
    loadButton.prop('disabled', true).html(`<img src="../images/spin.gif" width="48px">`);
    $.ajax({
      method: 'GET',
      url: '/getImages/' + currentYear,
    }).then(function({year, collection, repeat}) {
      if (repeat) {
        currentYear -= 1;
        ajaxCall();
        return;
      }

      if (collection) {
        $(template(collection, year)).insertBefore(loadButton);
        $('.skavt-post-image').not('.skavt-post-image-animation').each(displayImages);
        currentYear = year - 1;
      } else {
        $('<h3 style="text-align:center;">Ni več slik.</h3>').insertBefore(loadButton);
        loadButton.remove();
      }
      loadButton.prop('disabled', false).html('Več slik');
    });
  }

})(window);
