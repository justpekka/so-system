<?php

namespace App\Http\Middleware;

use App\Models\LoginToken;
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
        $result = LoginToken::where('token', session()->get('access_token'))
                    ->whereRaw('last_used_at is null')
                    ->first();

        if($request->routeIs('user_login')) {
            if( $result ) return redirect(route('dashboard.index'));
            return $next($request);
        };

        if( !$result ) {
            $request->session()->forget('access_token');
            return redirect(route('user_login'))->with(['errors' => 'You are a guest.']);
        };
        
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // ...
    }
}
