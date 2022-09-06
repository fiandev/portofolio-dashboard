<?php
namespace App\Helpers;

use App\Models\Apikey;
class ApikeyGenerator {
  private static function randomString ($len = 7){
    if ($len > 100) {
      throw new Exception('to long request length of apikey!');
    }
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $result = "";
    for ($i = 0; $i < $len; $i++) {
       $result .= $chars[rand(0, strlen($chars))];
    }
    
    /* check if exist */
    if (Apikey::where("key", $result)->first()) {
      self::randomString($len);
    }
    
    return $result;
  }
  private static function generate ($len = 7){
    $key = self::randomString($len);
    return $key;
  }
  
  public static function generateApikey ($len = 7){
    return self::generate($len);
  }
}