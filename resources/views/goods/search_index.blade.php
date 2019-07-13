@extends('layouts/default')

@section('title', '商品検索結果')

@section('content')

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
@endsection