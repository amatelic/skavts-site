/*jshint esnext: true */
import 'jquery';
import {ajax} from 'jquery';
import Modal from './modal';

export default class UsersTable {
    constructor(table, modal) {
      this.table = table;
      this.events();
      this.modal = new Modal(modal);
    }

    http(url, param, method) {
      return ajax({
        method: method || 'GET',
        url: url,
        data: {param},
      });
    }

    events() {
      this.table.on('click',  '#delete', (e) => {
        var id = $(e.target).data('id');
        this.http('/admin/users/' + id, {}, 'DELETE').then((data) => alert(data.text));
      });
    }

    displayUsers(users) {
      this.table.empty();
      users.forEach((user, index) => {
        this.table.append(this.template(user));
      });
    }

    template(user) {
      return `
        <tr>
          <td>${user.id}</td><td>${user.name}</td><td>${user.email}</td><td>${user.rights}</td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" >Spremeni</button></td>
          <td><button type="button" id="delete" class="btn btn-danger" data-id="${user.id}">Izbriši</button></td>
        <tr>`;
    }
}
