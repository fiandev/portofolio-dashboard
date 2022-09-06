<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
      return view("register.index", [
        "title" => "register page",
      ]);
    }
    
    public function store(Request $request){
      $validate = $request->validate([
        "name" => "required|min:3|max:255|unique:users",
        "username" => "required|min:3|max:255|unique:users",
        "email" => "required|email:rfc|unique:users",
        "password" => "required|min:5|max:255"
      ]);
      $validate["password"] = bcrypt($validate["password"]);
      
      $newUser = User::create($validate);
      return redirect("/login")->with("registered", "registrasion successfully!, please login.");
    }
}
