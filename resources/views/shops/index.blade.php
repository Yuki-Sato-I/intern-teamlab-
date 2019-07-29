@extends('layouts/default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goods_index.css') }}">
@endsection

@section('title', 'shop一覧')

@section('content')

<h1 class="goods-index-title">shop一覧</h1>
<div class="goods-index-container">
@foreach ($shops as $item)
<a class="goods-link" href={{ url("/shops/{$item['id']}") }}>
  <ul class="goods-container">
    <li><span>
      @if (!isset($item['image']))
        <img src="{{ asset('image/noimage.png') }}">
      @else 
        <img src="{{ $item['image'] }}">
      @endif
    </li></span>
    <div class="goods-name">{{ $item['name'] }}</div>
  </ul>
</a>
@endforeach
</div>
@endsection