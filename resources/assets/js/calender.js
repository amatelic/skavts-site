import modal from './modal';

var calender = (function() {
  var date = new Date();
  var month = date.getMonth();
  var year = date.getFullYear();
  var head = $('.head-dates');
  var body = $('.body-dates');
  var className = 'skavt-circle';
  var content;
  var dialog;

  function createHead(year) {
    var tr = '<tr><td colspan="7">' + year + '</td></tr><tr>';
    var days = ['N','P','T','S','Č','P','S'];
    days.forEach((day) => {
      tr += '<td>' + day + '</td>';
    });
    tr += '</tr>';
    return tr;
  }

  function dates(years, months) {
    var date = new Date(year, months);
    var row = new Array(7);
    var col = [];
    var i = 0;
    while (date.getMonth() == months) {
      if (row[6]) {
        col[i] = row;
        i++;
        row = new Array(7);
      }

      row[date.getDay()] = date.getDate();
      date.setDate(date.getDate() + 1);
    }

    col[4] = row;
    return col;
  }

  function createBody(days, ajax) {
    var tr = '';
    days.forEach((day, index) => {
      tr += '<tr>' + createColumn(day, ajax) + '</td>';
    });
    return tr;
  }

  function createColumn(data, collection) {
    var concat = '';
    for (var i = 0; i < 7; i++) {
      var day = (typeof data[i] === 'undefined' ? '' : data[i]);
      var classAdd = addClass(collection, data[i], `class='${className}'`);
      var dataId = addClass(collection, data[i], `data-content='${data[i]}'`);
      concat += '<td '  + dataId + ' ' + classAdd + '>' + day + '</td>';
    }

    return concat;
  }

  function addClass(collection = {}, number, value) {
    return (collection.indexOf(number) !== -1) ? value : '';
  }

  function createCalender(days, ajaxData) {
    //body.empty();
    head.html(createHead(year));
    body.html(createBody(days, ajaxData));
  }

  function addEvents() {
    body.find(`.${className}`).on('click', (e) => {
      var id = $(e.target).data('content');
      dialog.show(content[id]);
    });
  }

  return {
    init: function(modal) {
      var days = dates(year, month);
      $.get('/notification', { year, month }, (res) => {
        content = res;
        createCalender(days, res.dates);
        dialog = modal;
        dialog.init();
        addEvents();
      }).fail(function() {

        createCalender(days, []); //on errors display empty
      });
    },
  };
})();

calender.init(modal);
