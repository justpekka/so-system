<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboardController extends Controller
{
    public function __construct()
    {

    }

    public function __invoke(Request $request)
    {
        return $this->index($request);
    }

    public function index(Request $request)
    {
        
    }
}
