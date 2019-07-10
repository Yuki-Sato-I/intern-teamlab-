<?php

namespace app\lib;

class Helper {
  
  public static function api_return_result($url) {

    //自分で処理したいから自動エラーなくす    
    $context = stream_context_create(["http"=> ["ignore_errors" => true]]);
    $response = file_get_contents($url, false, $context);
    
    preg_match('/HTTP\/1\.[0|1|x] ([0-9]{3})/', $http_response_header[0], $matches);
    $statusCode = $matches[1];

    return [intval($statusCode), json_decode($response, true)];
  }
}

?>