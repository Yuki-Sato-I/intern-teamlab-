@extends('layouts/default')

@section('css')
<link rel="stylesheet" href="{{asset('css/goods_show.css')}}">
@endsection

@section('script')
  <script src="{{ asset('js/goods_show.js') }}" type="text/javascript"></script> 
@endsection

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
      <h2 style="text-align: center;">{{ $goods['price'] }}円</h2>
      <p><a href={{ url("goods/{$goods['id']}/edit") }} class="btn btn-primary btn-sm">編集</a>
        <form action="/goods/{{ $goods['id'] }}" method="post" id="del">
          @csrf
          {{ method_field('delete') }}
        <a onclick="deleteGoods(this);" href="#" class="btn btn-danger btn-sm">削除</a></p>
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
