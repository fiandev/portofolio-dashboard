<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\InboxController;
use App\Http\Controllers\API\UserAccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(["apikey"])->group(function (){
  Route::get("/profile/{user}", [UserAccountController::class, "index"])->name("api.profile");
  /* contact inbox */
  Route::get("/inbox/{user}", [InboxController::class, "index"]);
  Route::post("/inbox/{user}", [InboxController::class, "store"]);
  
});