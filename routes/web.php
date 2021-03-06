<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


if(config('app.env') === 'production'){
    // asset()やurl()がhttpsで生成される
    URL::forceScheme('https');
}

Route::get('/', function () {
    return redirect('/goods');
});

Route::resource('goods', 'GoodsController');

Route::get('/404error', function() {
    return view('layouts/404error');
});

Route::get('/error', function() {
    return view('layouts/error');
});

Route::get('/search', 'GoodsController@search');

Route::get('/search-index', 'GoodsController@search_index');

Route::get('/shops', 'ShopsController@index');

Route::get('/shops/{id}', 'ShopsController@show');