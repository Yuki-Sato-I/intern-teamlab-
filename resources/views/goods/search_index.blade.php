@extends('layouts/default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goods_index.css') }}">
@endsection

@section('title', '商品検索結果')

@section('content')

@php
  $url = "/search-index?";
  foreach ($searchInfo as $key => $value) {
    if ($key == 'shop'){
      $query = "goods_shop";
    } elseif ($key == 'title') {
      $query = "goods_title";
    } elseif ($key == 'priceLower') {
      $query = "price_lower";
    } elseif ($key == "priceUpper") {
      $query = "price_upper";
    }
    $url .= "{$query}={$value}&";
  }
  $searchInfo = str_replace('%20', ' ', $searchInfo);
@endphp

<h1 class="goods-index-title">検索結果</h1>
<p style="text-align:center;">
  検索条件(
@foreach ($searchInfo as $key => $value)
@if ($key == 'shop')
  ショップ名
@elseif ($key == 'title')
  商品名
@elseif ($key == 'priceLower')
  最低価格
@elseif ($key == "priceUpper")
  最高価格
@endif
:{{$value}},
@endforeach
  )
</p>
@if ($goods)
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
        <li><a href={{ url("{$url}page={$i}") }}
            @if($i == $currentPage)
              class="active"
              style="pointer-events: none;"
            @endif
        ><span>{{ $i }}</span></a></li>
      @endfor
    </ui>
  </div>
@else
  <h1 style="text-align:center;">お探しの商品はございません</h1>
@endif
@endsection