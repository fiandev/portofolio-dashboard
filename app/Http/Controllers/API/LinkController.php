<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Apikey;
use App\Models\Link;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    private $types = ["github", "facebook", "linkedin", "twitter", "instagram", "tiktok"];
   
    private function apikeySelf ($request, $user) {
      /* check apikey self */
      $apikey = Apikey::where("key", $request->apikey)
      ->where("user_id", $user->id)
      ->first();
      
      return $apikey ? true : false;
  }
  public function index(Request $request, User $user)
    { 
      if (!$this->apikeySelf($request, $user)) {
        return ApiResponse::setData(403, "this apikey is invalid with this profile!");
      }
      
      return ApiResponse::setData(200, "success", $user->links);
    }
    
    public function store(User $user, Request $request)
    {
        if (!$this->apikeySelf($request, $user)) {
          return ApiResponse::setData(403, "this apikey is invalid with this profile!");
        } 
        
        $rules = [
          "type" => "required",
          "url" => "required|max:255",
        ];
        
        $validate = Validator::make($request->all(), $rules);
        
        if ($validate->fails()) {
          return ApiResponse::setError(200, "failed", "data request is invalid", $validate->errors());
        }
        if (!in_array($request->type, $this->types)) {
          return ApiResponse::setError(200, "failed", "url type ". $request->type. " is invalid", "type url must be ".implode(",", $this->types));
        }
        
        $newData = Link::create([
          "user_id" => $user->id,
          "url" => $request->url,
          "type" => $request->type,
          "uid" => uniqid()
        ]);
        
        return ApiResponse::setData(200, "success", [
          "type" => $newData->type,
          "url" => $newData->url,
        ]);
    }
}
