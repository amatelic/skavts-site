import $ from 'jquery';
(function() {
  //Better code

  var $loggin = $('.login-user');
  var $loginForm = $('.skavt-login');

  $('.login-user').on('click', (e) => {
    if ($loginForm.is('#animateDown')) {
      $loginForm.removeAttr('id', 'animateDown');
    } else {
      $loginForm.attr('id', 'animateDown');
    }
  });

  $('.see-more').on('click', (e) => {
    e.preventDefault();
    $(e.target).parent().find('.skavt-post').slideDown().removeClass('truncate');
    $(e.target).parent().find('.skavt-post-gallery').slideDown();
  });
})();
