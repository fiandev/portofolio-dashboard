<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\InboxController;
use App\Http\Controllers\API\UserAccountController;
use App\Http\Controllers\API\LinkController;

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
  /* links */
  Route::get("/links/{user}", [LinkController::class, "index"])->name("api.links");
  Route::post("/links/{user}", [LinkController::class, "store"]);
  /* contact inbox */
  Route::get("/inbox/{user}", [InboxController::class, "index"]);
  Route::post("/inbox/{user}", [InboxController::class, "store"]);
  
});