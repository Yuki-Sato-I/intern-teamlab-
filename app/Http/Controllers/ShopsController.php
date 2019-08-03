<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\lib\Helper;

class ShopsController extends Controller
{
    //一覧ページ
    public function index(){
        $url = config('url.shop');
        $data = Helper::api_return_result($url);
        
        if($data != ["失敗"]){
            return view('shops/index', ['shops' => $data]);
        } else {
            return redirect('/error');
        }
    }

    //詳細ページ
    public function show($id){
        $url = config('url.shop').'?id='.$id;
        $shopData = Helper::api_return_result($url);

        if($shopData != ["失敗"]){
            $url = config('url.goods').'?shop='.$shopData['name'];
            $data = Helper::api_return_result($url);
            if($data != ["失敗"]){
                return view('shops/show', ['shop' => $shopData, 'goods' => $data]);
            } 
        }

        return redirect('/error');
    }
}
