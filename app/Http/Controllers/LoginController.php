<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    public function __invoke()
    {
        // default controller method.
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('log')->only('index');
        $this->middleware('subscribed')->except('store');
    }

    public function login(Request $request) {
        return "welcome to Login controller.";
            if($_SERVER["REQUEST_METHOD"] === 'POST') {
                return $request;
            };
            
            return view('index')
                ->with('request', $request);

        /** @use this method or __construct() method for compiling the middleware
        $this->middleware(function ($request, $next) {
            return $next($request);
        });
        */
    }
}
