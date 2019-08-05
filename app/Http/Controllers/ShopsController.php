<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\lib\Helper;

class ShopsController extends Controller
{
    //一覧ページ
    public function index(Request $request){
        $page = $request->query('page') ?? "1";
        $url = config('url.shop')."?page=".$page;
        $data = Helper::api_return_result($url);
        //dataが一個のみの場合の対応
        if(isset($data['id'])){
            $data = [$data];
        }
        if($data != ["失敗"]){
            return view('shops/index', ['shops' => $data]);
        } else {
            return redirect('/error');
        }
    }

    //詳細ページ
    public function show($id, Request $request){
        $url = config('url.shop').'?id='.$id;
        $shopData = Helper::api_return_result($url);

        if($shopData != ["失敗"]){
            $page = $request->query('page') ?? "1";
            $url = config('url.goods').'?shop='.$shopData['name']."&page=".$page;
            $itemData = Helper::api_return_result($url);
            if($itemData != ["失敗"]){
                //dataが一個のみの場合の対応
                if(isset($itemData['id'])){
                    $itemData = [$itemData];
                }
                return view('shops/show', ['shop' => $shopData, 'goods' => $itemData]);
            } 
        }

        return redirect('/error');
    }
}
