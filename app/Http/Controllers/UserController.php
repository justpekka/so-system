<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\User;

class UserController extends Controller
{
    protected $models;

    public function __construct()
    {
        $this->models['user'] = User::class;
    }

    public function __invoke(Request $request)
    {
        return $this->index($request);
    }

    public function index(Request $request)
    {        
        $findUser = json_decode(User::first());
        $password = $findUser->password;
        
        $comparePassword = password_verify('password', $password);
        print_r($comparePassword);
        print_r(session()->all());
        return;
    }

    public function list(Request $request)
    {
        $user = json_decode($this->models['user']::get());

        echo "<pre>";
        print_r($user);
        return;
    }
}