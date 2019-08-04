<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\lib\Helper;

class GoodsController extends Controller
{
    //一覧ページ
    public function index(){
        $url = config('url.goods');
        $data = Helper::api_return_result($url);

        if($data != ["失敗"]){
            return view('goods/index', ['goodsInfo' => $data]);
        } else {
            return redirect('/error');
        }
    }

    //検索ページ
    public function search(){
        $url = config('url.shop');
        $data = Helper::api_return_result($url);

        if($data != ["失敗"]){
            return view('goods/search', ['shops' => $data]);
        } else {
            return redirect('/error');
        }
    }

    //検索結果ページ
    public function search_index(Request $request){
        $url = config('url.goods').'?';

        $title = $request->input('goods_title');
        $shop = $request->input('goods_shop');
        $priceLower = $request->input('price_lower');
        $priceUpper = $request->input('price_upper');
        $searchInfo = [];

        if (!empty($title)) {
            $searchInfo += ["title" => $title]; 
            $title = urlencode($title);
            $url .= "title={$title}&";
        }
        if (!empty($shop)) {
            $searchInfo += ["shop" => $shop];
            $shop = urlencode($shop);
            $url .= "shop={$shop}&";
        }
        //0がemptyになるため
        if (!($priceLower === null) && !($priceUpper === null)) {
            $url .= "priceLower={$priceLower}&priceUpper={$priceUpper}";
            $searchInfo += ["priceLower" => (int)$priceLower, "priceUpper" => (int)$priceUpper];
        }

        $data = Helper::api_return_result($url);
        //dataが一個のみの場合の対応
        if(isset($data['id'])){
            $data = [$data];
        }
        if($data != ["失敗"]){
            return view('goods/search_index', ['goods' => $data, 'searchInfo' => $searchInfo]);
        } else {
            return redirect('/error');
        }
    }

    //詳細ページ
    public function show($id){
        $url = config('url.goods').'?id='.$id;
        $data = Helper::api_return_result($url);

        if($data != ["失敗"]){
            return view('goods/show', ['goods' => $data]);
        } else {
            return redirect('/error');
        }
    }

    //新規登録ページ
    public function create(){
        $url = config('url.shop');
        $data = Helper::api_return_result($url);

        if($data != ["失敗"]){
            return view('goods/create', ['shops' => $data]);
        } else {
            return redirect('/error');
        }
    }

    //商品登録
    public function store(Request $request){
        //base64にエンコードして保存する
        if (!empty($request->file('goods_image'))) {
            $mimeType = $request->file('goods_image')->getMimeType();
            $imageData = "data:" . $mimeType . ";base64," . base64_encode(file_get_contents($request->file('goods_image')->getRealPath()));
        } else {
            $imageData = null;
        }
        
        $data = [
            'image' => $imageData,
            'title' => $request->input('goods_title'),
            'content' => $request->input('goods_content'),
            'price' => (int)$request->input('goods_price'),
            'shop' => $request->input('goods_shop')
        ];

        $data = json_encode($data);

        $options = [
            // HTTPコンテキストオプションをセット
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json; charset=UTF-8', //json形式で送る
                'content' => $data
                ]
        ];
        $context = stream_context_create($options);
        $contents = file_get_contents(config('url.goods'), false, $context);

        if (!empty(json_decode($contents)->status)){
            $flash = ["success" => "登録に成功しました"];
        }else{
            $flash = ["danger" => "登録に失敗しました"];
        }
        
        return redirect('/goods')->with('flash', $flash);
    }

    //編集ページ
    public function edit($id){
        $url = config('url.goods').'?id='.$id;
        $goodsData = Helper::api_return_result($url);

        if($goodsData != ["失敗"]){
            $url = config('url.shop');
            $shopsData = Helper::api_return_result($url);
            if($shopsData != ["失敗"]){
                return view('goods/edit', ['goods' => $goodsData, 'shops' => $shopsData]);
            }
        }

        return redirect('/error');
    }

    //商品編集
    public function update($id, Request $request){
        $url = config('url.goods');
        //base64にエンコードして保存する
        if (!empty($request->file('goods_image'))) {
            $mimeType = $request->file('goods_image')->getMimeType();
            $imageData = "data:".$mimeType.";base64,".base64_encode(file_get_contents($request->file('goods_image')->getRealPath()));
        } elseif (!empty($request->input('pre_goods_image'))) {
            $imageData = $request->input('pre_goods_image');
        } else {
            $imageData = null;
        }
                
        $data = [
            'id' => $id,
            'image' => $imageData,
            'title' => $request->input('goods_title'),
            'content' => $request->input('goods_content'),
            'price' => (int)$request->input('goods_price'),
            'shop' => $request->input('goods_shop')
        ];
        $data = json_encode($data);

        $options = [
            // HTTPコンテキストオプションをセット
            'http' => [
                'method' => 'PUT',
                'header' => 'Content-type: application/json; charset=UTF-8', //json形式で送る
                'content' => $data
                ]
        ];

        $context = stream_context_create($options);
        $contents = file_get_contents($url, false, $context);
        
        if (!empty(json_decode($contents)->status)){
            $flash = ["success" => "編集に成功しました"];
        }else{
            $flash = ["danger" => "編集に失敗しました"];
        }

        return redirect("/goods/{$id}")->with('flash', $flash);
    }

    //商品削除
    public function destroy($id){
        $url = config('url.goods').'?id='.$id;
        $options = [
            'http' => [
                'method' => 'DELETE'
                ]
            ];
        $context = stream_context_create($options);
        $contents = file_get_contents($url, false, $context);

        if (!empty(json_decode($contents)->status)){
            $flash = ["success" => "削除に成功しました"];
        }else{
            $flash = ["danger" => "削除に失敗しました"];
        }

        return redirect("/goods")->with('flash', $flash);
    }
}
