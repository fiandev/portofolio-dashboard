<?php

namespace App\Http\Controllers;

use App\Models\Apikey;
use App\Models\User;
use App\Helpers\ApikeyGenerator;
use Illuminate\Http\Request;

class ApikeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $apikeys = Apikey::where("user_id", $user->id)->paginate(5);
        return view("dashboard.apikey.index", [
          "apikeys" => $apikeys
        ]);
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
    public function store(Request $request)
    {
        $user = auth()->user();
        Apikey::create([
          "key" => ApikeyGenerator::generateApikey(16),
          "user_id" => $user->id
        ]);
        
        return back()->with("success", "new apikey has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apikey  $apikey
     * @return \Illuminate\Http\Response
     */
    public function show(Apikey $apikey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apikey  $apikey
     * @return \Illuminate\Http\Response
     */
    public function edit(Apikey $apikey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apikey  $apikey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apikey $apikey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apikey  $apikey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apikey $apikey)
    {
        Apikey::destroy($apikey->id);
        
        return back()->with("success", "an apikey has been delete!");
    }
}
