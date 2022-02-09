<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Undefined;

use App\Http\Controllers\Sales\CustomersController;
use App\Http\Controllers\Sales\EmployeesController;
use App\Http\Controllers\Sales\OfficesController;
use App\Http\Controllers\Sales\OrderDetailsController;
use App\Http\Controllers\Sales\OrdersController;
use App\Http\Controllers\Sales\PaymentsController;
use App\Http\Controllers\Sales\ProductLinesController;
use App\Http\Controllers\Sales\ProductsController;


class QueryBuilder extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    const Customers = CustomersController::class;    
    const Employees = EmployeesController::class;    
    const Offices = OfficesController::class;    
    const OrderDetails = OrderDetailsController::class;    
    const Orders = OrdersController::class;    
    const Payments = PaymentsController::class;    
    const ProductLines = ProductLinesController::class;    
    const Products = ProductsController::class;    

    public function __invoke(Request $request)
    {
        return view('sales.dashboard');
    }
}
