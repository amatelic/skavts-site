/*jshint esnext: true */
import $ from  'jquery';
import 'jquery';
import UsersTable from './users/displayUsers';

(function(window) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
  });
  let table = $('tbody');
  let filter = $('#filter');
  let UserTable = new UsersTable(table, '#myModal');

  filter.on('keyup', function(e) {
    e.preventDefault();
    UserTable.http('/admin/users/filter', filter.val())
    .then(UserTable.displayUsers.bind(UserTable));
  });

  $('.show-add-fields').on('click', function() {
    $('.add-user').slideToggle();
  });

})(window);
