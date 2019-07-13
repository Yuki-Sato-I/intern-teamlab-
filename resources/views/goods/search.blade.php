@extends('layouts/default')

@section('title', '商品検索')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1>商品情報検索</h1>
    <form action="/search-index" method="get" enctype="multipart/form-data">
      @csrf
      <div>
        <label for="title">商品名</label>
        <input type="text" id="title" name="goods_title" class="form-control">
      </div>
      <div class="form-row">
        <div class="form-group col-sm-6">
          <label for="price_lower">最低価格</label>
          <input type="number" id="price_lower" name="price_lower" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-sm-6">
          <label for="price_upper">最高価格</label>
          <input type="number" id="price_upper" name="price_upper" class="form-control">
        </div>
      </div>
      <div>
        <label for="shop">ショップ名</label>
        <input type="text" id="shop" name="goods_shop" class="form-control">
      </div>
      <div>
        <input type="submit" value="送信" class="btn btn-primary btn-block">
      </div>
    </form>
  </div>
</div>
@endsection