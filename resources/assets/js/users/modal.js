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
      modal.find('.modal-body').html(_this.template(_this.getParams(input, 'text')));
    });

    $('#save-modal').on('click', function(e) {
      let newInput = $(e.target).parent().siblings('.modal-body').find('input, select');
      var input = _this.getParams(newInput, 'val');
      _this.http('/admin/users/' + input.id, input, 'PUT')
        .then(function(res) {
          alert(res.text);
        }, function(e) {

          console.log(e);
        });
    });
  }
  
  getParams(data, method) {
    let id = $(data[0])[method]();
    let name = $(data[1])[method]();
    let email = $(data[2])[method]();
    let role = $(data[3])[method]();
    return {id, name, email, role};

  }

  http(url, param, method) {
    return ajax({
      method: method || 'GET',
      url: url,
      data: param,
    });
  }

  template({id, name, email, role}) {
    return `
      <form class="form-horizontal">
      <input type="hidden" class="form-control" id="username" value=${id}>
        <div class="form-group">
          <label for="username" class="col-sm-2 control-label">Uporabnik:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="username" value=${name}>
          </div>
          <label for="email" class="col-sm-2 control-label">Email:</label>
          <div class="col-sm-10">
            <input type="input" class="form-control" id="email" value=${email}>
          </div>
          <label for="username" class="col-sm-2 control-label">Veja:</label>
          <div class="col-sm-10">
            <select class="form-control">
                <option>IV</option>
                <option>PP</option>
                <option>SKVO</option>
              </select>
          </div>
        </div>
      </form>
      `;
  }
}
