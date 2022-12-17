<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\OTP_Generator;
use Illuminate\Http\Request;
use App\Models\OTP;

class OTPController extends Controller
{
    public function index (Request $request) {
      $email = $request->email;
      
      OTP::create([
        "user_id" => auth()->user()->id,
        "code" => OTP_Generator::Generate()
      ]);
      
      /* OTP to user has been sent */
      $exist = OTP::where("user_id", auth()->user()->id)->first();
      if ($exist) {
        OTP::where("user_id", $exist->author->id)->delete();
      }
      
      return response()->json([
        "status" => true,
        "message" => "new OTP Has been sent to $email"
      ]);
    }
}
