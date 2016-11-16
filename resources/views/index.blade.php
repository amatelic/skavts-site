@extends('master')
@section('left')
    @include('includes.calender')
@endsection
@section('center')
  @foreach($notifications as $notification)
    @include('includes.notification', $notification)
  @endforeach
@endsection
