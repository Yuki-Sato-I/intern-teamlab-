@extends('layouts/default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goods_index.css') }}">
@endsection

@section('title', '商品ページ')

@section('content')

<h1 class="goods-index-title">商品ページ</h1>
@if ($goodsInfo)
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
  <div class="my-pager">
    <ui class="my-pagination">
      @for($i = 1; $i <= $pageCount; $i++)
        <li><a href={{ url("/goods?page={$i}") }}
            @if($i == $currentPage)
              class="active"
              style="pointer-events: none;"
            @endif
        ><span>{{ $i }}</span></a></li>
      @endfor
    </ui>
  </div>
@else
  <h1 syle="text-align:center;">商品はございません</h1>    
@endif

@endsection



