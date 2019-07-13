@extends('layouts/default')

@section('css')
<link rel="stylesheet" href="{{asset('css/goods_create.css')}}">
@endsection

@section('title', '新規商品登録')

@section('content')
<div class="row" style="margin: 50px auto;">
  <div class="col-md-6 col-md-offset-3">
    <h1 style="text-align: center;">新規商品登録</h1>
    <form action="/goods" method="post" enctype="multipart/form-data">
      @csrf
      <div>
        <label for="title">商品名</label>
        <input type="text" id="title" name="goods_title" class="form-control" required>

        <label for="content">商品詳細</label>
        <textarea name="goods_content" id="content" rows="6" class="form-control" required></textarea>

        <label for="image">商品画像</label>
        <input type="file" id="image" name="goods_image">

        <label for="price">商品値段</label>
        <input type="number" id="price" name="goods_price" class="form-control" required>

        <label for="shop">ショップ名</label>
        <input type="text" id="shop" name="goods_shop" class="form-control" required>
        <div style="margin: 10px auto;">
          <input type="submit" class="btn btn-primary btn-block" value="送信">
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
