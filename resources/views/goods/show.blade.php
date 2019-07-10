@extends('layouts/default')

@section('title', $goods['title'].'のページ')

@section('content')
<div class="goods-show-container">
  <div class="goods-show-goods">
    <div class="goods-image-price">
      @if (!isset($goods['image']))
        <img src="{{ asset('image/noimage.png') }}">
      @else
        <img src={{ $goods['image'] }}>
      @endif
      <h2 style="text-align: center;"><!-- ショップリンク,後で追加する。 -->
        {{ $goods['price'] }}円 | <a href="/">{{ $goods['shop'] }}</a>
      </h2>
    </div>
    <div class="goods-show-detail">
      <h1>{{ $goods['title'] }}</h1>
      <div class="goods-show-content">
        {!! nl2br(e($goods['content'], false)) !!}
      </div>
    </div>
  </div>
</div>
@endsection