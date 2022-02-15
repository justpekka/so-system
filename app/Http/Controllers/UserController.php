<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\User;

class UserController extends Controller
{
    public function __invoke(Request $request)
    {
        return $this->index($request);
    }

    public function index(Request $request)
    {
        session(['provider', 'SIKAB']);
        
        $findUser = json_decode(User::first());
        $password = $findUser->password;
        
        $comparePassword = password_verify('password', $password);
        print_r($comparePassword);
        print_r(session()->all());
        return;
    }
}