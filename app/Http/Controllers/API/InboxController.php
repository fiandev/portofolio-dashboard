<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use App\Models\User;
use App\Models\Apikey;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Validator;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function apikeySelf ($request) {
      /* check apikey self */
      $apikey = Apikey::where("key", $request->apikey)->first();
      if (!$apikey) {
        return ApiResponse::setData(403, "this apikey is invalid with this profile!");
      }
    }
    public function index(User $user, Request $request)
    {
      $this->apikeySelf($request);
      return ApiResponse::setData(200, "success", $user->inboxes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        $this->apikeySelf($request);
        
        $rules = [
          "sender" => "required|min:3|max:255",
          "message" => "required|min:1|max:255",
        ];
        
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
          return ApiResponse::setError(200, "failed", "data request is invalid", $validate->errors());
        }
        
        $newInbox = Inbox::create([
          "user_id" => $user->id,
          "message" => $request->message,
          "sender" => $request->sender
        ]);
        
        return ApiResponse::setData(200, "success", [
          "message" => $newInbox->message,
          "sender" => $newInbox->sender,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function show(Inbox $inbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Inbox $inbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inbox $inbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inbox $inbox)
    {
        //
    }
}
