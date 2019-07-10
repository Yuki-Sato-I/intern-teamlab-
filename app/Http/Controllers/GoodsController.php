<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\lib\Helper;

class GoodsController extends Controller
{
    
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

    }

    public function show($id){
        $url = "https://ifive.sakura.ne.jp/yuki/yuksi_goods.php?id={$id}";
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
