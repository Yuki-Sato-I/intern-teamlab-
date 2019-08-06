<?php

namespace app\lib;

class Helper {
  
  //apiを叩いて,データを取得する関数
  /**
   * $url: 受信先url
   */
  public static function api_return_result($url) {
    //自分で処理したいから自動エラーなくす    
    $context = stream_context_create(["http"=> ["ignore_errors" => true]]);
    $response = file_get_contents($url, false, $context);
    
    preg_match('/HTTP\/1\.[0|1|x] ([0-9]{3})/', $http_response_header[0], $matches);
    $statusCode = $matches[1];

    if($statusCode == "200"){
      $data = json_decode($response, true);
      if(count($data) == 1){
        $data = current($data);
      }
    }else{
      $data = ["失敗"];
    }
    return $data;
  }

  //データを送信する関数
  /**
   * $data: 送信するデータ
   * $url: 送信先url
   * $method: HTTPリクエストメソッド
   */
  public static function api_send_data($data, $url, $method) {
    $data = json_encode($data);
    $options = [
      // HTTPコンテキストオプションをセット
      'http' => [
          'method'  => $method,
          'header'  => 'Content-type: application/json; charset=UTF-8', //json形式で送る
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

    return $flash;
  }


}

?>