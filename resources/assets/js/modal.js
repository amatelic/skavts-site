var modal = (function() {
  var body = $('body');
  var $window = $(window);
  var modal = $('<div>').addClass('modal-skavti').hide().on('click', hideAll);
  var layer = $('<div/>').css({
    width: $window.width(),
    height: $window.height(),
  }).addClass('black-box').hide().on('click', hideAll);
  function hideAll() {
    modal.hide();
    layer.hide();
  }

  function showModal(data) {
    layer.show();
    modal.html(template(data)).show();
  }

  function template({title, body}) {
    return `
      <div>
        <h1>${title}</h1>
        <p>${body}</p>
      </div>`;
  }

  return {
    init: function() {
      body.append(layer);
      body.append(modal);
    },

    show: showModal,
  };
})();

export default modal;
