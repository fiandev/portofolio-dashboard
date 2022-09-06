<?php
namespace App\Helpers;

class ApiResponse {
  public static function setData ($code = 200, $message = null, $data = null) {
    $response = [];
    
    if (!$data) {
      $response["code"] = $code;
      $response["status"] = "failed";
      $response["message"] = $message;
    } else {
      $response["code"] = $code;
      $response["message"] = $message;
      $response["data"] = $data;
    }
    
    return response()->json($response);
  }
  
  public static function setError ($code = 500, $status = null, $message = null, $error = null) {
    $response = [];
    $response["code"] = $code;
    $response["status"] = $status;
    $response["message"] = $message;
    $response["error"] = $error;
    
    return response()->json($response);
  }
}