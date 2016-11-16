@extends('adminMaster')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        @if(count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error}}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
      <h3>Dodaj novo novico</h3>
      <form method="POST" id="articleForm" action="/admin/notifications">
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="nameOfStory">Naslov dogodka:</label>
          <input type="text" name="title" class="form-control" id="nameOfStory" placeholder="Naslov dogodka">
        </div>
        <div class="form-group">
          <label for="textContent">Vsebina:</label>
          <textarea name="body" id="textContent" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="dateOfStory">Kdaj:</label>
          <input type="date" name="will_be" class="form-control" id="dateOfStory" placeholder="dd/mmm/yyyy">
        </div>
        <button type="submit" class="btn btn-primary">Objavi</button>
      </form>
    </div>
    <div class="col-md-6" >
      <div id="displayArticles" class="col-md-12">
        <h2>Zadnje novice:</h2>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td>Novica</td><td>Izbriši</td>
            </tr>
          </thead>
          <tbody class="artilceBody">
            @foreach($notifications as $notification)
              <tr>
                <td>
                  {{$notification->title}}
                </td>
                <td>
                  <button type="button" data-id="{{$notification->id}}" class="delete-button btn btn-danger">Izbriši</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {!! $notifications->render() !!}
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script type="text/javascript" src="/js/notification.js"></script>
@endsection
