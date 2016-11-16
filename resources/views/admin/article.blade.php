@extends('adminMaster')

@section('content')
  <div class="row">
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
    <div class="col-md-6">
      <h3>Dodaj novo novico</h3>
      <form method="POST" id="articleForm" action="/admin/articles">
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="nameOfStory">Ime zgodbe:</label>
          <input type="text" class="form-control" id="nameOfStory" name="title" placeholder="Naslov vsebine">
        </div>
        <div class="form-group">
          <label for="textContent">Vsebina:</label>
          <textarea name="body" id="textContent" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="textContent">Leto:</label>
          <select name="year" class="form-control">
            @for($i=(int)(date('Y')); $i > 2002; $i--)
              <option value="{{$i}}">{{$i}}</option>
            @endfor
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Objavi</button>
      </form>
    </div>
    @if(Auth::user()->isAdmin())
      <div class="col-md-6" >
        <div id="displayArticles" class="col-md-12">
          <h2>Zgodovina novic:</h2>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <td>Novica</td><td>Spremeni</td><td>Izbriši</td>
              </tr>
            </thead>
            <tbody class="artilceBody">
              @foreach($articles as $article)
                <tr>
                  <td data-id="{{$article->id}}">
                    <p class="article-name">{{$article->title}}</p>
                    <input type="hidden" name="name" value="{{$article->body}}">
                  </td>
                  <td>
                    <button type="button" data-id="{{$article->id}}" id="change" data-toggle="modal" data-target="#myModal" class="btn btn-primary ">Spremeni</button>
                  </td>
                  <td>
                    <button type="button" data-id="{{$article->id}}" id="delete" class="btn btn-danger ">Izbriši</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {!! $articles->render() !!}
      </div>
    @endif
</div>
@endsection

@section('script')
  <script type="text/javascript" src="/js/article.js"></script>
@endsection
