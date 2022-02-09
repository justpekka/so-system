<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Sales\Customer;

class CustomersController extends Controller
{
    /**
     * $users = Customer::select();
     * $users1 = $users::addSelect();
     * $users = Customer::get();
     * $users = Customer::first();
     * $users = Customer::where($column, $param)->get() or ->first();
     * $users = Customer::where($column, $param)->value($singleColumn);
     * $users = Customer::find($defaultId);
     * $users = Customer::where()->exists();
     * $users = Customer::where()->doesntExist();
     * 
     * $users = Customer::distinct($defaultId);
     * 
     * $users = Customer::pluck($column, $columnKey);
     * $users = Customer::chunk($chunks, function($results) { // return false;});
     */
    public function __invoke(Request $request, $id = null)
    {
        $titles = Customer::get();
        return view('sales.dashboard', ['titles' => json_decode($titles)]);
    }

    public function index(Request $request, $id = null)
    {
        $users = DB::table('customers')->get();
        if($id != null) $users = DB::table('customers')->where("customerNumber", '=', $id)->first();
        return view('sales.index', ['users' => $users]);
        // return "Hello World!";
    }
}
