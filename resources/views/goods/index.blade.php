@extends('layouts/default')

@section('css')
<link rel="stylesheet" href="{{asset('css/goods_index.css')}}">
@endsection

@section('title', '商品ページ')

@section('content')

<h1 class="goods-index-title">商品ページ</h1>
<div class="goods-index-container">
@foreach ($goodsInfo as $item)
<a class="goods-link" href={{ url("/goods/{$item['id']}") }}>
  <ul class="goods-container">
    <li><span>
      @if (!isset($item['image']))
        <img src="{{ asset('image/noimage.png') }}">
      @else 
        <img src="{{ $item['image'] }}">
      @endif
    </li></span>
    <div class="goods-name">{{ $item['title'] }}</div>
  </ul>
</a>
@endforeach
</div>
@endsection



