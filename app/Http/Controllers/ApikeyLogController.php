<?php

namespace App\Http\Controllers;

use App\Models\ApikeyLog;
use App\Models\Apikey;
use Illuminate\Http\Request;

class ApikeyLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apikey $apikey, Request $request)
    {  
      $by = "desc";
      $list = ["latest", "oldest"];
      
      if ($request->sortby) {
        switch ($request->sortby) {
            case 'latest' : $by = "desc";
          break;
            case "oldest" : $by = "asc";
          break;
           default: $by = "asc";
           break;
        }
      }
      
       $logs = ApikeyLog::where("apikey_id", $apikey->id)->orderBy("created_at", $by)->paginate(5);
       
        return view("dashboard.apikey-log.index", [
          "logs" => $logs,
          "sortby" => $request->sortby ?? "",
          "listSort" => $list,
          "apikey" => $apikey
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
     * @param  \App\Http\Requests\StoreApikeyLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApikeyLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApikeyLog  $apikeyLog
     * @return \Illuminate\Http\Response
     */
    public function show(ApikeyLog $apikeyLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApikeyLog  $apikeyLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ApikeyLog $apikeyLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApikeyLogRequest  $request
     * @param  \App\Models\ApikeyLog  $apikeyLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApikeyLogRequest $request, ApikeyLog $apikeyLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApikeyLog  $apikeyLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apikey $apikey)
    {
      
      if ( ApikeyLog::where("apikey_id", $apikey->id)->delete() ) return back()->with("success", sprintf("log for apikey %s has been removed!", $apikey->key));
      else return back()->with("error", sprintf("can't remove log for apikey %s", $apikey->key));
        
    }
}
