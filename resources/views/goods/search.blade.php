@extends('layouts/default')

@section('title', '商品検索')

@section('script')
  <script src="{{ asset('js/goods_search.js') }}" type="text/javascript"></script> 
@endsection

@section('content')
<div class="row" style="margin: 50px auto;">
  <div class="col-md-6 col-md-offset-3">
    <h1 style="text-align: center;">商品情報検索</h1>
    <form action="/search-index" method="get" enctype="multipart/form-data" name="form">
      @csrf
      <div>
        <label for="title">商品名</label>
        <input type="text" id="title" name="goods_title" class="form-control">
      </div>
      <div class="form-row">
        <div class="form-group col-sm-6" style="padding: 0;">
          <label for="price_lower">最低価格</label>
          <input type="number" id="price_lower" name="price_lower" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-sm-6" style="padding: 0;">
          <label for="price_upper">最高価格</label>
          <input type="number" id="price_upper" name="price_upper" class="form-control">
        </div>
      </div>
      <div>
        <label for="shop">ショップ名</label><br>
        <select name="goods_shop" required>
          <option></option>
          @foreach ($shops as $shop)
            <option value={{ $shop["name"] }}>{{ $shop["name"] }}</option>
          @endforeach
        </select>
      </div>
      <div style="margin: 10px auto;">
        <input type="submit" value="送信" class="btn btn-primary btn-block"  onclick="check(this);return false;">
      </div>
    </form>
  </div>
</div>
@endsection