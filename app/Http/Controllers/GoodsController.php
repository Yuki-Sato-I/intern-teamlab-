<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class GoodsController extends Controller
{
    
    public function index(){
        $baseUrl = "https://ifive.sakura.ne.jp/yuki/yuki_goods.php";
        $response = file_get_contents($baseUrl);
        $goodsInfo = json_decode($response,true);

        return view('goods/index', compact('goodsInfo'));
    }

    //ここは後で　検索用
    public function search(){

    }

    public function show($id){

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
