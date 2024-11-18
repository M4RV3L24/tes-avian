<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    public function report () {
        $customers = Customer::with('purchases')->get();
        return view('report', ['customers' => $customers]);
    } 
}
