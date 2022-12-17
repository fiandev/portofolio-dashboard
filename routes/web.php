<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSkillController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserChangePasswordController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ApikeyController;
use App\Http\Controllers\ApikeyLogController;
use App\Http\Controllers\InboxController;

Route::middleware(["guest"])->group( function (){
  Route::get('/', function (Request $request){
    return redirect("/login");
  });
  Route::get('/login', [LoginController::class, "index"])->name("login");
  Route::post('/login', [LoginController::class, "authenticate"]);
  
  /* register */
  Route::get('/register', [RegisterController::class, "index"])->name("register");
  Route::post('/register', [RegisterController::class, "register"]);
  
});

Route::middleware(["auth"])->group( function (){
  Route::get('/register/confirm', [RegisterController::class, "confirm"])->name("register.confirm");
  Route::get('/register/verify/{otp}', [RegisterController::class, "autoVerify"]);
  Route::post('/register/confirm', [RegisterController::class, "verify"]);
});

Route::middleware(["auth", "userVerified"])->group( function (){
  Route::get('/', function (Request $request){
    return redirect("/dashboard");
  });
  Route::post('/logout', [LoginController::class, "logout"]);
  Route::get('/dashboard', [DashboardController::class, "index"])->name("dashboard");
  
  /* skills */
  Route::resource('/skills', DashboardSkillController::class);
  
  /* links */
  Route::resource('/links', LinkController::class);
  
  /* apikey */
  Route::resource('/apikey', ApikeyController::class);
  
  /* inbox */
  Route::get("/inbox", [InboxController::class, "index"])->name("user.inbox");
  Route::post("/inbox", [InboxController::class, "markAll"]);
  Route::delete("/inbox", [InboxController::class, "deleteAll"]);
  Route::delete("/inbox/{inbox}", [InboxController::class, "destroy"]);
  Route::get("/inbox/{inbox}", [InboxController::class, "show"]);
  
  /* apikey log */
  Route::get("/apikey-log/{apikey}", [ApikeyLogController::class, "index"]);
  Route::delete("/apikey-log/{apikey}", [ApikeyLogController::class, "destroy"]);
  
  Route::get("/user/account", [UserAccountController::class, "show"])->name("user.account");
  Route::get("/user/account/edit", [UserAccountController::class, "edit"])->name("user.account.edit");
  Route::post("/user/account", [UserAccountController::class, "update"]);
  Route::delete("/user/account", [UserAccountController::class, "destroy"]);
  
  Route::get("/user/account/change-password", [UserChangePasswordController::class, "index"])->name("user.changePassword");
  Route::post("/user/account/change-password", [UserChangePasswordController::class, "update"]);
  
});

Route::get('/post-images/{filename}', function($filename){
  $path = storage_path('app/' . "post-images/" . $filename);
  
  if (!File::exists($path)) {
      abort(404);
  }

  $file = File::get($path);
  $type = File::mimeType($path);

  $response = Response::make($file, 200);
  $response->header("Content-Type", $type);

  return $response;
});