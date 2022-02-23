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

    public function handle(Request $request, Closure $next)
    {
        $login_status = $request->session()->get('access_token');

        if($request->routeIs('user_login')) {
            if( $login_status ) return redirect(route('detail', ["code" => "copper_sock"]));
            // if( $login_status ) return $request;
            
            return $next($request);
        };

        if( !$login_status ) return redirect(route('user_login'))->with(['errors' => 'You are a guest.']);
        
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // ...
    }
}
