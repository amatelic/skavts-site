import $ from 'jquery';
(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
  });

  var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
  var isChrome = !!window.chrome && !isOpera;
  var text = 'Tvoj brskalnik ne podpira date pickerja zato uporabli chrome ali pa napisi datum v tem formatu 12/04/2015';
  if (!isChrome) {
    $('#dateOfStory').after(`<br/><p class="bg-warning">${text}</p>`);
  }

  $('.delete-button').on('click', function(e) {
    let target = $(e.target);
    $.ajax({
      method: 'DELETE',
      url: '/admin/notifications/' + target.data('id'),
    }).then(function(respond) {
      $(e.target).closest('tr').remove();
    });
  });
})();
