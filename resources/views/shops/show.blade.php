@extends('layouts/default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goods_show.css') }}">
<link rel="stylesheet" href="{{ asset('css/goods_index.css') }}">
@endsection

@section('title', $shop['name'].'のページ')

@section('content')
<div class="goods-show-container">
  <div class="goods-show-goods">
    <div class="goods-image-price">
      @if (!isset($shop['image']))
        <img src="{{ asset('image/noimage.png') }}">
      @else
        <img src={{ $shop['image'] }}>
      @endif
    </div>
    <div class="goods-show-detail">
      <h1>{{ $shop['name'] }}</h1>
      <div class="goods-show-content">
        {!! nl2br(e($shop['content'], false)) !!}
      </div>
    </div>
  </div>
</div>
<h1 class="goods-index-title">このshopの商品</h1>
<div class="goods-index-container">
  @foreach ($goods as $item)
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
<div class="my-pager">
  <ui class="my-pagination">
    @for($i = 1; $i <= $pageCount; $i++)
      <li><a href={{ url("/shops/{$shop['id']}?page={$i}") }}
          @if($i == $currentPage)
            class="active"
            style="pointer-events: none;"
          @endif
      ><span>{{ $i }}</span></a></li>
    @endfor
  </ui>
</div>
@endsection