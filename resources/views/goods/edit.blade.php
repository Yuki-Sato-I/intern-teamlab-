@extends('layouts/default')

@section('title', '商品情報更新')

@section('content')
<div class="row" style="margin: 50px auto;">
  <div class="col-md-6 col-md-offset-3">
    <h1 style="text-align: center;">商品情報編集</h1>
    <form action="/goods/{{ $goods['id'] }}" method="post" enctype="multipart/form-data">
      <!-- post対応していない -->
      <input name="_method" type="hidden" value="PUT">
      @csrf
      <div>
        <label for="title">商品名</label>
        <input type="text" id="title" name="goods_title" value={{$goods['title']}} class="form-control" required>
        
        <label for="content">商品詳細</label>
        <textarea id="content" name="goods_content" class="form-control" rows="6" required>{{$goods['content']}}</textarea>
        
        <label for="image">商品画像(png,jpeg,jpgのみ)</label>
        <input type="file" id="image" name="goods_image" value={{$goods['image']}} class="form-control" accept="image/png, image/jpeg, image/jpg">
        
        <label for="price">商品値段</label>
        <input type="number" id="price" name="goods_price" value={{$goods['price']}} class="form-control" required>

        <label for="shop">ショップ名</label><br>
        <select name="goods_shop" required>
          <option></option>
          @foreach ($shops as $shop)
            <option value={{ $shop["name"] }}
            @if ($shop['name'] == $goods['shop'])
                selected
            @endif
            >{{ $shop["name"] }}</option>
          @endforeach
        </select><br>
        <div style="margin: 10px auto;">
          <input type="submit" value="送信" class="btn btn-primary btn-block">
        </div>
      </div>
    </form>
  </div>
</div>
@endsection