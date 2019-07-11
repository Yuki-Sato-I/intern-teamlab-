@extends('layouts/default')

@section('title', '新規商品登録')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1>新規商品登録</h1>
    <form action="/goods" method="post" enctype="multipart/form-data">
      @csrf
      <div>
        <label for="title">商品名</label>
        <input type="text" id="title" name="goods_title" class="form-control" required>
      </div>
      <div>
          <label for="content">商品詳細</label>
        <textarea name="goods_content" id="content" rows="6" class="form-control" required></textarea>
      </div>
      <div>
        <label for="image">商品画像</label>
        <input type="file" id="image" name="goods_image">
      </div>
      <div>
        <label for="price">商品値段</label>
        <input type="number" id="price" name="goods_price" class="form-control" required>
      </div>
      <div>
        <label for="shop">ショップ名</label>
        <input type="text" id="shop" name="goods_shop" class="form-control" required>
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
        <input type="submit" class="btn btn-primary btn-block" value="送信">
      </div>
    </form>
  </div>
</div>
@endsection
