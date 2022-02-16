<?php

namespace App\Http\Middleware;

use Closure;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;

class UserHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        /**
         * How to use middleware after request.
            // $response = $next($request);
            // // Perform action
            // return $response;
        */
        
        // if ( $request ) {
        //     return back();
        // }

        // if (! $request->session()->get('user') ) {
            // return "You are not logged in.";
            // return redirect('/login', 401);
        // }

        return $next($request);
    }
    
    public function terminate($request, $response)
    {
        // ...
    }
}
