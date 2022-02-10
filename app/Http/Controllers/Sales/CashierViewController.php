<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sales\Customer;
use App\Models\Sales\Orders;
use App\Models\Sales\OrderDetails;
use App\Models\Sales\Payments;

class CashierViewController extends Controller
{
    public function __invoke() 
    {
        return $this->index();
    }

    public function index()
    {
        $customerList = Customer::take(5)->get();
        return view('sales.cashier', ['custList' => json_decode($customerList), 'test' => "<H1> Hello World! </H1>"]);
    }
}
