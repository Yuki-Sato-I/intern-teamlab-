<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\lib\Helper;

class GoodsController extends Controller
{
    
    public function index(){
        $url = "https://ifive.sakura.ne.jp/yuki/yuki_goods.php";
        $goodsInfo = Helper::api_return_result($url);

        return view('goods/index', compact('goodsInfo'));
    }

    //ここは後で　検索用
    public function search(){

    }

    public function show($id){
        $url = "https://ifive.sakura.ne.jp/yuki/yuki_goods.php?id={$id}";
        $goods = Helper::api_return_result($url);
        //errorコードだったら
        if (ctype_digit($goods)) {
            return view('layouts/error', ['statusCode' => $goods]);
        }else{
            return view('goods/show', ['goods' => current($goods)]);
        }
    }

    public function create(){

    }

    public function store(){

    }

    public function edit($id){

    }

    public function update($id){

    }

    public function destroy($id){

    }
}
