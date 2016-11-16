import $ from 'jquery';

let main = $('.steg-main');
$('.steg_nav_li').on('click', function(e) {
  e.preventDefault();
  let url = $(e.target).attr('href');
  $.get('static_content/' + url.substr(1) + '.html').then((data) => {
    main.html(data);
  });
});
