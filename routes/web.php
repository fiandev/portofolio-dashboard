<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSkillController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\LinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(["guest"])->group( function (){
  Route::get('/', function (Request $request){
    return redirect("/login");
  });
  Route::get('/login', [LoginController::class, "index"])->name("login");
  Route::post('/login', [LoginController::class, "authenticate"]);
  
});

Route::middleware(["auth"])->group( function (){
  Route::get('/', function (Request $request){
    return redirect("/dashboard");
  });
  Route::post('/logout', [LoginController::class, "logout"]);
  Route::get('/dashboard', [DashboardController::class, "index"]);
  
  /* skills */
  Route::resource('/skills', DashboardSkillController::class);
  
  /* links */
  Route::resource('/links', LinkController::class);
  

  Route::get("/user/account", [UserAccountController::class, "show"])->name("user.account");
  Route::get("/user/account/edit", [UserAccountController::class, "edit"])->name("user.account.edit");
  
  Route::post("/user/account", [UserAccountController::class, "update"]);
  Route::delete("/user/account", [UserAccountController::class, "destroy"]);
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