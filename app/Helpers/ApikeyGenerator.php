<?php
namespace App\Helpers;

use App\Models\Apikey;
class ApikeyGenerator {
  private static function randomString ($length){
    if ($length > 100) {
      throw new Exception('to long request length of apikey!');
    }
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    
    $result = substr(str_shuffle(str_repeat($chars, ceil($length / strlen($chars)) )), 1, $length);
    
    /* check if exist */
    if (Apikey::where("key", $result)->first()) {
      return self::randomString($length);
    }
    
    return $result;
  }
  private static function generate ($length){
    return self::randomString($length);
  }
  
  public static function generateApikey ($length = 7){
    return self::generate($length);
  }
}