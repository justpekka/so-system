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

    protected $wrongMessage;

    public function __construct()
    {
        $this->wrongMessage = ["wrong route method!"];
        return; 
    }

    public function handle(Request $request, Closure $next)
    {
        $response = ["error", "wrong method!"];
        if( $request->getMethod() == "GET" ) return redirect()->route('ApiV1');

        return $next($request);
    }

    public function terminate($request, $response)
    {
        // ...
    }
}
