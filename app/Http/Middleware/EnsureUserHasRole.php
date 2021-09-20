<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
         
        //is now an array with all the roles you provided to the route.
    
        if (!$request->user() || !in_array($request->user()->role, $roles)) {
            // Redirect...
                           
            return back();
        }
                            
        return $next($request);           
    }
}
