<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * All Customers
     */
    public function all_customers(){
        $customers = Customer::orderBy('id', 'DESC')->get();
        return response()->json([
            'customers' => $customers
        ]);
    }

}
