@extends('layouts/default')

@section('content')
<div class="goods-show-container">
  <div class="goods">
    @if (!isset($goods['image']))
      <img src="{{ asset('image/noimage.png') }}">
    @else
      <img src={{ $goods['image'] }}>
    @endif
    <h1>{{ $goods['title'] }}</h1>
    <div class="goods-content">
      {{$goods['content'] }}
    </div>
  </div>
</div>
@endsection