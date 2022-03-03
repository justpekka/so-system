<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

use App\Models\User;
use App\Models\LoginToken;

class ApiControllerV1 extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function __invoke(Request $request)
    {
        return $this->index($request);
    }
    
    public function index(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        echo 'Hello, World! This is my API V1 progress. Stay updated, Okay?';
        return; 
    }
    
    /** @var V1Auth RouteController */
    public function registerUser(Request $request)
    {
        $validated = $request->validateWithBag('POST', [
            'username' => ['bail', 'required', 'unique:users', 'min:5', 'max:12'],
            'password' => ['required', 'min:5'],
            'first_name' => ['required', 'min:2', 'max:20'],
            'last_name' => ['min:2', 'max:20'],
        ]);

        return $validated;
    }

    public function login(Request $request)
    {
        // Handling the Default (GET) Method
        if( $request->getMethod() == "GET" ) return view('user.login');

        // Handling the Default (POST) Method
        $username = $request->get('username');
        $password = $request->get('password');
        $result = json_decode(
            User::where('username', '=', $username)
                ->orWhere('email', '=', $username)
                ->first() 
        );

        if( !$result ) {
            return response(['message' => 'There is no username or email in the list.'], 401)->header('content-type', 'application/json');
        }
        
        $password_match = password_verify( $password, $result->password );
        if( !$password_match ) {
            return response(['message' => 'Wrong password!'], 401)->header('content-type', 'application/json');
        }
        
        // Checking if token is already registered
        if( session()->get('access_token') ) return redirect()->route('dashboard.index');

        $rand_token = password_hash($result->remember_token, PASSWORD_DEFAULT);
        LoginToken::insert([
            'user_id' => $result->id,
            'token' => $rand_token,
        ]);

        session(['access_token' => $rand_token]);
        return response(['token' => $rand_token, 'role'], 200, ['content-type' => 'application/json']);
    }
    
    public function logout(Request $request)
    {
        $token = $request->get('access_token');
        if ( !$token ) $token = session()->get('access_token');        
        $status = LoginToken::where('token', $token)->update(['last_used_at' => date('Y-m-j H:i:s')]);

        if( $status ) {
            session()->forget('access_token');
            return response(["message" => "Logout success."], 200);
        };
        
        return response(["message" => "unauthorized user."], 401);
        // return response(["message" => [$token], "result" => json_decode($status)]);
    }
    /** End of @var V1Auth RouteController */
}
