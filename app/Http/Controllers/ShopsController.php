<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\lib\Helper;

class ShopsController extends Controller
{
    public function index(){
        $url = config('url.shop');
        $data = Helper::api_return_result($url);
        switch($data[0]){
            case 200:
                return view('shops/index', ['shops' => $data[1]]);
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
        $url = config('url.shop').'?id='.$id;
        $data = Helper::api_return_result($url);
        switch($data[0]){
            case 200:
                $shop = current($data[1]);
            break;
            case 404:
                return redirect('/404error');
            break;
            default :
                return redirect('/error');
            break;
        }

        $url = config('url.goods').'?shop='.$shop['name'];
        $data = Helper::api_return_result($url);
        switch($data[0]){
            case 200:
                return view('shops/show', ['shop' => $shop, 'goods' => $data[1]]);
            break;
            case 404:
                return redirect('/404error');
            break;
            default :
                return redirect('/error');
            break;
        }

    }
}
