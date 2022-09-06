<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Apikey;
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
        
        if (!$apikey) {
          return ApiResponse::setData(403, "missing or invalid apikey");
        }
        /* update log apikey */
        Apikey::whereId($apikey->id)->update([
          "used" => $apikey->used + 1
        ]);
        
        return $next($request);
    }
}
