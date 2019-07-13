<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\lib\Helper;

class GoodsController extends Controller
{
    //ここのエラー処理なんかヤダ
    public function index(){
        $url = "https://ifive.sakura.ne.jp/yuki/yuki_goods.php";
        $data = Helper::api_return_result($url);
        switch($data[0]){
            case 200:
                return view('goods/index', ['goodsInfo' => $data[1]]);
            break;
            case 404:
                return redirect('/404error');
            break;
            default :
                return redirect('/error');
            break;
        }
    }

    //ここは後で　検索用
    public function search(){
        return view('goods/search');
    }

    public function search_index(Request $request){
        $url = "https://ifive.sakura.ne.jp/yuki/yuki_goods.php?";

        $title = $request->input('goods_title');
        $shop = $request->input('goods_shop');
        $priceLower = $request->input('price_lower');
        $priceUpper = $request->input('price_upper');
        $searchInfo = [];
        if (!empty($title)) {
            $url .= "title={$title}&";
            $searchInfo += ["title" => $title]; 
        }
        if (!empty($shop)) {
            $url .= "shop={$shop}&";
            $searchInfo += ["shop" => $shop];
        }
        //0がemptyになるため
        if (!($priceLower === null) && !($priceUpper === null)) {
            $url .= "priceLower={$priceLower}&priceUpper={$priceUpper}";
            $searchInfo += ["priceLower" => (int)$priceLower, "priceUpper" => (int)$priceUpper];
        }
        $data = Helper::api_return_result($url);
        switch($data[0]){
            case 200:
                return view('goods/search_index', ['goods' => $data[1], 'searchInfo' => $searchInfo]);
            break;
            case 404:
                return redirect('/404error');
            break;
            default :
                return redirect('/error');
            break;
        }
    }

    public function show($id){
        $url = "https://ifive.sakura.ne.jp/yuki/yuki_goods.php?id={$id}";
        $data = Helper::api_return_result($url);
        switch($data[0]){
            case 200:
                return view('goods/show', ['goods' => current($data[1])]);
            break;
            case 404:
                return redirect('/404error');
            break;
            default :
                return redirect('/error');
            break;
        }
    }

    public function create(){
        return view('goods/create');
    }

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
                'method'=> 'POST',
                'header'=> 'Content-type: application/json; charset=UTF-8', //json形式で送る
                'content' => $data
                ]
        ];
        $context = stream_context_create($options);
        $contents = file_get_contents('https://ifive.sakura.ne.jp/yuki/yuki_goods.php', false, $context);

        if (!empty(json_decode($contents)->status)){
            $flash = ["success" => "登録に成功しました"];
        }else{
            $flash = ["danger" => "登録に失敗しました"];
        }
        
        return redirect('/goods')->with('flash', $flash);
    }

    public function edit($id){
        $url = "https://ifive.sakura.ne.jp/yuki/yuki_goods.php?id={$id}";
        $data = Helper::api_return_result($url);

        switch($data[0]){
            case 200:
                $goods = current($data[1]);
            break;
            case 404:
                return redirect('/404error');
            break;
            default :
                return redirect('/error');
            break;
        }

        return view('goods/edit', ['goods' => $goods]);
    }

    public function update($id, Request $request){
        $url = 'https://ifive.sakura.ne.jp/yuki/yuki_goods.php';
        //base64にエンコードして保存する
        if (!empty($request->file('goods_image'))) {
            $mimeType = $request->file('goods_image')->getMimeType();
            $imageData = "data:" . $mimeType . ";base64," . base64_encode(file_get_contents($request->file('goods_image')->getRealPath()));
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

    public function destroy($id){
        $url = "https://ifive.sakura.ne.jp/yuki/yuki_goods.php?id={$id}";
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
