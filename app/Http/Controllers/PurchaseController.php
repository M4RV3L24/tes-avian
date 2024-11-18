<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //

    public function insert(Request $request) {

        $validated = $request->validate([
            'customer_id' => 'required',
            'purchase_date' => 'required',
            'total_price' => 'required',
        ]);


        try {
            $purchase = new Purchase();
            // check if the customer_id exists
            $customer = Customer::find($request->customer_id);
            if (!$customer) {
                throw new Exception('Customer not found');
            }
            $purchase->customer_id = $request->customer_id;
            $purchase->purchase_date = $request->purchase_date;
            $purchase->total_price = $request->total_price;
            $purchase->save();
            return redirect()->back()->with('success', 'Purchase inserted successfully');
        }

        catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
