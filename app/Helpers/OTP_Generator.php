<?php
namespace App\Helpers;
use App\Models\OTP;

class OTP_Generator {
  private const LENGTH_CODE = 6;
  
  private static function random_OTP($len) {
    $result = "";
    for ($i = 0; $i < $len; $i++) {
       $result .= rand(0, 9);
    }
    
    if (OTP::where("code", $result)->first()) return self::random_OTP($len);
    
    return $result;
  }
  public static function generate () {
    return self::random_OTP(self::LENGTH_CODE);
  }
}