<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
          return redirect("/dashboard");
        }
        return view("login.index");
    }
    
    public function authenticate(Request $request)
    {
      try {
        $credentials = $request->validate([
          "email" => "required|email|",
          "password" => "required"
        ]);
        if (Auth::attempt($credentials)) {
          $request->session()->regenerate();
          return redirect()->intended("dashboard");
        }
        
      } catch (\Exception $e ) {
        return back()->with("loginError", $e ?? "login failed!");
      }
      
    }
    
    public function logout(Request $request){
      Auth::logout();
      
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      
      return redirect('/');
    }
}
