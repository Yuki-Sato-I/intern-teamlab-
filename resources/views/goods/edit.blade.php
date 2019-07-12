@extends('layouts/default')

@section('title', '商品情報更新')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1>商品情報編集</h1>
    <form action="/goods/{{ $goods['id'] }}" method="post" enctype="multipart/form-data">
      <!-- post対応していない -->
      <input name="_method" type="hidden" value="PUT">
      @csrf
      <div>
        <label for="title">商品名</label>
        <input type="text" id="title" name="goods_title" value={{$goods['title']}} class="form-control" required>
      </div>
      <div>
        <label for="content">商品詳細</label>
        <textarea id="content" name="goods_content" class="form-control" rows="6" required>{{$goods['content']}}</textarea>
      </div>
      <div>
        <label for="image">商品画像</label>
        <input type="file" id="image" name="goods_image" value={{$goods['image']}} class="form-control">
      </div>
      <div>
        <label for="price">商品値段</label>
        <input type="number" id="price" name="goods_price" value={{$goods['price']}} class="form-control" required>
      </div>
      <div>
        <label for="shop">ショップ名</label>
        <input type="text" id="shop" name="goods_shop" value={{$goods['shop']}} class="form-control" required>
      </div>
      <!-- 店の概念を追加した時,に使う部分 -->
      <!--
      <select name="goods_shop" required>
        <option></option>
        <option value="0">男性</option>
        <option value="1">女性</option>
      </select><br>
      -->
      <div>
        <input type="submit" value="送信" class="btn btn-primary btn-block">
      </div>
    </form>
  </div>
</div>
@endsection