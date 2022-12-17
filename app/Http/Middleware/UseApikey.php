<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Apikey;
use App\Models\ApikeyLog;
use App\Helpers\ApiResponse;

class UseApikey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apikey = Apikey::where("key", $request->apikey)->first();
        
        if (!$apikey) return ApiResponse::setData(403, "missing or invalid apikey");
        
        /* create log for apikey */
        ApikeyLog::create([
          "apikey_id" => $apikey->id,
          "data" => [
              "IP_ADDRESS" => $request->ip(),
              "USER_AGENT" => $request->server("HTTP_USER_AGENT"),
              "DATE" => date("D, d-m-Y h:i:s")
            ]
        ]);
        
        /* update total apikey used */
        Apikey::whereId($apikey->id)->update([
          "used" => $apikey->used + 1
        ]);
        
        return $next($request);
    }
}
