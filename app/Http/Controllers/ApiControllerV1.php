<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

use App\Models\User;

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
        if( $request->getMethod() == "POST" ) {
            $result = json_decode( User::where('username', $request->get('username'))->first() );

            if(! $result ) return response(json_encode(['message' => 'Invalid username.']), 402)->header('content-type', 'application/json');
            return;
        };

        $sesi = session()->all();
        $session = array (
            $sesi,
            $request->all(),
        );

        return view('user.login', ['session' => $session]);
    }
    
    public function logout(Request $request)
    {
        $inputted_data = $request->all();
        if(! empty($inputted_data["name"]) )
        {
            return $inputted_data["name"];
        };

        return $inputted_data;
    }
    /** End of @var V1Auth RouteController */
}
