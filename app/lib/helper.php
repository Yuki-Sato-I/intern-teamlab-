<?php

namespace app\lib;

class Helper {
  
  public static function api_return_result($url) {
    //自分で処理したいから自動エラーなくす
    /*
    $context = stream_context_create(["http"=> ["ignore_errors" => true]]);
    $response = file_get_contents($url, false, $context);
    if($response === false) {
      if(isset($http_response_header) && count($http_response_header) > 0) {
        $status = explode(' ', $http_response_header[0]);
        switch($status) {
          case 404:
            // Not Found
            break;
          case 500:
            // Internal Server Error
            break;
          default:
            // その他
            break;
        }
      } else {
            // タイムアウト
      }
    }
    */
    $response = file_get_contents($url);
    return json_decode($response, true);
  }

}

?>