@extends('layouts/default')

@section('title', '新規商品登録')

@section('content')
<h1>新規商品登録</h1>
<form action="/goods" method="post" enctype="multipart/form-data">
  @csrf
  <div><input type="text" name="goods_title" required></div>
  <div><input type="text" name="goods_content" required></div>
  <div><input type="file" name="goods_image"></div>
  <div><input type="number" name="goods_price" required></div>
  <div><input type="text" name="goods_shop" required></div>
  <!-- 店の概念を追加した時,に使う部分 -->
  <!--
  <select name="goods_shop" required>
      <option></option>
      <option value="0">男性</option>
      <option value="1">女性</option>
    </select><br>
  -->
  <div><input type="submit" value="送信"></div>
</form>
@endsection
