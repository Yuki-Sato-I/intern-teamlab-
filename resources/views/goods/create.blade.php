@extends('layouts/default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goods_create.css') }}">
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
        <textarea name="goods_content" id="content" rows="6" class="form-control" maxlength="500" required></textarea>

        <label for="image">商品画像(png,jpeg,jpgのみ)</label>
        <input type="file" id="image" name="goods_image" accept="image/png, image/jpeg, image/jpg">

        <label for="price">商品値段</label>
        <input type="number" id="price" name="goods_price" class="form-control" min="0" required>

        <label for="shop">ショップ名</label><br>
        <select name="goods_shop" required>
          <option></option>
          @foreach ($shops as $shop)
            <option value={{ $shop["name"] }}>{{ $shop["name"] }}</option>
          @endforeach
        </select><br>
        <!--
        <input type="text" id="shop" name="goods_shop" class="form-control" required>
        -->
        <div style="margin: 10px auto;">
          <input type="submit" class="btn btn-primary btn-block" value="送信">
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
