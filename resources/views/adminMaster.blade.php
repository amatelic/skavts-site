<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin-pannel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{csrf_token()}}"/>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Skavti Bovec1</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
            <li><a href="/admin">Domov</a></li>
            <li><a href="/admin/notifications">Obvestila</a></li>
              <li><a href="/admin/articles">Dogodki</a></li>
              <li><a href="/admin/images">Slike</a></li>
              @if(Auth::user()->isAdmin())
                <li><a href="/admin/users">Uporabniki</a></li>
                {{-- <li><a href="/admin/learning">Veščine</a></li> --}}
              @endif
              <li><a href="auth/logout">Odjavi</a></li>
            @endif


          </ul>
        </div>
      </div>
    </nav>
  <div class="container">
       @yield('content')
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Uporabniska imena:</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zapri</button>
        <button type="button" id="save-modal"class="btn btn-primary">Shrani</button>
      </div>
    </div>
  </div>
</div>
</body>
@if ( Config::get('app.debug') )
  <script type="text/javascript">
    document.write('<script src="//localhost:35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
  </script>
@endif
<script src="https://code.jquery.com/jquery-2.1.4.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<div class="scripts">
     @yield('script')
</div>
</html>
