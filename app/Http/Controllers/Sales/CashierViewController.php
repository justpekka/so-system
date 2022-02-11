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
        // $customerList[0] = json_decode(Customer::select(['customerName', 'postalCode', 'phone'])->latest()->first());
        // $customerList[1] = json_decode(Customer::select(['customerName', 'postalCode', 'phone'])->first());
        $customerList = json_decode(
            Customer::
                select(['customers.customerNumber', 'customerName', 'postalCode', 'phone', 'orders.orderDate'])
                // select(['customers.customerNumber', 'customers.customerName', 'customers.postalCode', 'customers.phone', 'orders.orderDate'])
                ->take(5)
                ->join('orders', 'customers.customerNumber', '=', 'orders.customerNumber')
                ->orderBy('createdAt', 'desc')
                ->get()
        );

        // echo "<pre>";
        // print_r(json_decode($customerList));
        // return;
        return view('sales.cashier', ['custList' => $customerList]);
    }

    public function create()
    {
        $current = json_decode(Customer::latest()->select('customerNumber')->first());
        $current->customerNumber += 1;
        $customerList = Customer::
            insertGetId([
                'customerNumber' => $current->customerNumber,
                'customerName' => 'Jane Judith, .inc',
                'contactLastName' => 'Judith',
                'contactFirstName' => 'Jane',
                'phone' => '01 550034',
                'addressLine1' => 'indie street 2',
                'city' => 'Java',
                'state' => 'Blue',
                'postalCode' => '11240',
                'country' => 'Japan',
                'salesRepEmployeeNumber' => 1002,
                'creditLimit' => 0,
            ]);

        echo $customerList;
        return; 
    }

    public function update($id)
    {
        $customerList = Customer::
            find($id)
            ->update([
                'customerName' => 'Jane Doe, .inc',
                'contactLastName' => 'Judith',
                'contactFirstName' => 'Doe',
                'phone' => '01 550034',
                'addressLine1' => 'indie street 2',
                'city' => 'Java',
                'state' => 'Blue',
                'postalCode' => '11240',
                'country' => 'Japan',
                'salesRepEmployeeNumber' => 1002,
                'creditLimit' => 0,
            ]);

        echo $customerList;
        return; 
    }

    public function delete($id)
    {
        $customerList = Customer::find($id)->delete();

        echo $customerList;
        return; 
    }
}
