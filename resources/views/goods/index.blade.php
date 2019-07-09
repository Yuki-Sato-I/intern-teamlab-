@extends('layouts/default')
@php

@endphp

@section('content')
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



