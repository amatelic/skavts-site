@extends('master')
@section('left')
    @include('includes.calender')
@endsection
@section('center')
  @if(!empty($imagesByYear['collection']))
    @include('includes.images', $imagesByYear)
  @endif
    {{--  Loading images with ajax--}}
    <button type="submit" class="load-images">Več slik</button>
@endsection

@section('script')
  <script src="js/images.js" type="text/javascript">
  </script>
@endsection
