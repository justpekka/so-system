<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class ApiControllerV1 extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected $wrongMessage;

    public function __construct()
    {
        return $this->wrongMessage = ["wrong route method!"];
    }

    public function __invoke(Request $request)
    {
        return $this->index($request);
    }
    
    public function index(Request $request)
    {
        return 'Hello, World! This is my API V1 progress. Stay updated, Okay?';
    }
    
    /** @var V1Auth RouteController */
    public function auth(Request $request)
    {
        if( $request->getMethod() == "GET" ) return json_encode($this->wrongMessage);

        $inputted_data = $request->all();
        if(! empty($inputted_data["name"]) )
        {
            return $inputted_data["name"];
        };

        return $inputted_data;
    }

    public function registerUser(Request $request)
    {
        if( $request->getMethod() == "GET" ) return json_encode($this->wrongMessage);

        $inputted_data = $request->all();
        if(! empty($inputted_data["name"]) )
        {
            return $inputted_data["name"];
        };

        return $inputted_data;
    }
    
    public function login(Request $request)
    {
        if( $request->getMethod() == "GET" ) return json_encode($this->wrongMessage);

        $inputted_data = $request->all();
        if(! empty($inputted_data["name"]) )
        {
            return $inputted_data["name"];
        };

        return $inputted_data;
    }
    
    public function logout(Request $request)
    {
        if( $request->getMethod() == "GET" ) return json_encode($this->wrongMessage);

        $inputted_data = $request->all();
        if(! empty($inputted_data["name"]) )
        {
            return $inputted_data["name"];
        };

        return $inputted_data;
    }
    /** End of @var V1Auth RouteController */
}
