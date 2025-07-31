<?php

namespace App\Http\Middleware\Admin;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Role31
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
        if(Auth::guard('admin')->check()){
         if(Auth::guard('admin')->user()->type!="SUPER_ADMIN"){
          if(in_array("31", explode(",",Auth::guard('admin')->user()->roles))){
            return $next($request);
          }else{
            abort(403, "You don't have access of this page.");
          }  
         }else{
            return $next($request);
         }
        }
    }
}
