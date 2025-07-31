<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class Redirection301
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $host = $request->header('host');
        if(substr($host, 0, 4) != 'www.') {
          $request->headers->set('host', 'www.' . $host);
          return Redirect::to($request->path(), 301);
        }
        
        return $next($request);
    }
}