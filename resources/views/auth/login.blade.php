@extends('adminMaster')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h3>Prijavi se</h3>
      <form id="articleForm" method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="nameOfStory">Email:</label>
          <input type="text" name="email" class="form-control" id="nameOfStory" placeholder="Naslov vsebine">
        </div>
        <div class="form-group">
          <label for="textPassword">Geslo:</label>
          <input type="password" name="password" class="form-control" id="textPassword">
        </div>
        {{-- <div class="form-group">
          <input type="checkbox" name="remember"> Remember Me
        </div> --}}
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Prijavi</button>
        </div>

      </form>
    </div>
  </div>
    @if(count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error}}</li>
          @endforeach
        </ul>
      </div>
    @endif

@endsection
