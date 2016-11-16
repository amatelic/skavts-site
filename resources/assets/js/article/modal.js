/*jshint esnext: true */
import 'jquery';
import {ajax} from 'jquery';

export default class Modal {
  constructor(modal) {
    this.modal = $(modal);
    this.events();
  }

  events() {
    let _this = this;
    this.modal.on('shown.bs.modal', function(e) {
      let input =  $(e.relatedTarget).parent().siblings();
      let modal = $(this);
      modal.find('.modal-body').html(_this.template(_this.getParams(input)));
    });

    $('#save-modal').on('click', function(e) {
      let newInput = $(e.target).parent().siblings('.modal-body').find('input, textarea');
      var id =  newInput[0].value;
      var title = newInput[1].value;
      var body = newInput[2].value;
      _this.http('/admin/articles/' + id, {body, title}, 'PUT')
        .then(function(res) {
          alert(res);
        });
    });
  }

  getParams(data, method) {
    let title = $(data[0]).find('p').text();
    let id = $.trim($(data[0]).data('id'));
    let body = $(data[0]).find('input').val();
    return {id, title, body};

  }

  http(url, param, method) {
    return ajax({
      method: method || 'GET',
      url: url,
      data: param,
    });
  }

  template({id, title, body}) {
    return `
      <form class="form-horizontal">
      <input type="hidden" class="form-control" id="articles-form" value=${id}>
        <div class="form-group">
          <label for="textarea" class="col-sm-2 control-label">Title:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" value="${title}">
          </div>
        </div>
        <div class="form-group">
          <label for="textarea" class="col-sm-2 control-label">Text area:</label>
          <div class="col-sm-10">
            <textarea class="form-control"  rows="3">
              ${body}
            </textarea>
          </div>
        </div>
      </form>
      `;
  }
}
