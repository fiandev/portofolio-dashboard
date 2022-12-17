<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OTP;
use Illuminate\Http\Request;
use App\Mail\OTP_Code;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Helpers\OTP_Generator;

class RegisterController extends Controller
{
    public function index(){
      return view("register.index", [
        "title" => "register page",
      ]);
    }
    
    public function register(Request $request){
      $validate = $request->validate([
        "name" => "required|min:3|max:255|unique:users",
        "username" => "required|min:3|max:255|unique:users",
        "email" => "required|email:rfc|unique:users",
        "password" => "required|min:7|max:255"
      ]);
      $validate["password"] = bcrypt($validate["password"]);
      
      /* save Registration data and login */
      $newUser = User::create($validate);
      Auth::login($newUser);
      
      /* sent email */
      $email = $validate["email"];
      $otp = OTP::create([
        "user_id" => auth()->user()->id,
        "email" => auth()->user()->email,
        "code" => OTP_Generator::generate()
      ]);
      Mail::to($email)->send(new OTP_Code($otp));
      
      
      return redirect(route("register.confirm"))->with("message", "OTP code has been sent to $email!");
    }
    public function confirm(Request $request) {
      $user = auth()->user();
      
      return view("register.confirm", [
        "title" => "confirmation email",
        "user" => $user
      ]);
    }
    
    public function autoVerify(Otp $otp, Request $request) {
      $user = auth()->user();
      
      // invalid otp code
      if ($user->id !== $otp->user_id) return redirect(route("register.confirm"))->with("error", "otp invalid");
      
      $otp->destroy();
      User::whereId($user->id)
      ->update([
        "email_verified_at" => now()
      ]);
      
      return redirect(route("dashboard"))->with("welcome", "welcome ". $user->name .", have a nice day!");
    }
    
    public function verify(Request $request) {
      $validate = $request->validate([
        "otp" => "required|min:6"
      ]);
      
      $user = auth()->user();
      $otp = OTP::where("code", $validate["otp"])->first();
      if (!$otp) return back()->with("error", "OTP code is Invalid");
      if ($otp->user->id !== $user->id) return back()->with("error", "OTP code is Invalid");
      
      /* update user && delete otp */
      OTP::destroy($otp->id);
      User::whereId($user->id)
        ->update([
          "email_verified_at" => now()
        ]);
      
      return redirect(route("dashboard"))->with("welcome", "welcome ". $user->name .", have a nice day!");
    }
}
