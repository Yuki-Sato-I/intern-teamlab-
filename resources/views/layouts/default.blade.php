<!DOCTYPE html>
<html lang="ja">
<head>
  <title>
    @section('title')
      Laravel
    @show
  </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('css/header.css')}}">
  <link rel="stylesheet" href="{{asset('css/footer.css')}}">
  <link rel="stylesheet" href="{{asset('css/goods_index.css')}}">
  <link rel="stylesheet" href="{{asset('css/goods_show.css')}}">
  <link rel="stylesheet" href="{{asset('css/goods_create.css')}}">
</head>
@include('layouts/header')

@yield('content')

@include('layouts/footer')