@extends('master')
@section('left')
  <h4>Po letih:</h4>
  <ul>
  @for($i = $maxYear; $i >= $minYear; $i--)
    <li><a href="/articles/{{$i}}">{{$i}}</a></li>
  @endfor
  </ul>
    @include('includes.calender')
@endsection
@section('center')
  @for($i=0; $i < count($articles) ; $i++)
    @include('includes.posts', ['article' => $articles[$i], 'imagesDir' => $imageDir[$i]])
  @endfor
@endsection
@section('script')
  <script src="{{URL::asset('js/index.js')}}" type="text/javascript">
  </script>
@endsection
