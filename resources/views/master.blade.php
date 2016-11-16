<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Skavti bovec1</title>
  <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">

  <link href="{{URL::asset('lib/lightbox2/dist/css/lightbox.css')}}" rel="stylesheet">
</head>
<body>
  @include('includes.header')
  <main>
    <div id="left">
        @yield('left')
    </div>
    <div id="center">
      @yield('center')
    </div>
    <div id="right">
      {{-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur a, suscipit eum mollitia at illum ipsum asperiores earum vero quam quas eaque incidunt aliquam odit consequatur, libero beatae explicabo rerum. --}}
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-2.1.4.min.js" ></script>
  <script src="{{URL::asset('lib/lightbox2/dist/js/lightbox.min.js')}}"></script>
  <script src="{{URL::asset('js/calender.js')}}"></script>
  <div class="scripts">
       @yield('script')
  </div>
</body>
</html>
