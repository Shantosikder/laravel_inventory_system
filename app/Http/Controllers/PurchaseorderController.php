<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Unit;
use App\Models\Supplier;

class PurchaseorderController extends Controller
{
    function purchaseorder()
    {
        $suppliers = Supplier::all();
        $purchases = Purchase::all();
        return view('purchaseOrder.purchaseorder', compact('suppliers', 'purchases'));
    }


    public function purchaseorderPost(Request $data)
    {
        $data->validate([
            'supplier' => 'required',
            'date' => 'required',
            'order_no' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required'
        ]);

        $orderDate = date("d M, Y", strtotime($data->date));
        $supplier = Supplier::findOrFail($data->supplier);
        $allOrders = [];
        $grandTotal = 0;
        $order_no = $data->order_no;
        foreach ($data->product_name as $key => $name) {
            $total_price = $data->quantity[$key] * $data->unit_price[$key];
            $order = [
                'product_name' => $name,
                'quantity' => $data->quantity[$key],
                'unit_price' => $data->unit_price[$key],
                'total' => $total_price
            ];
            array_push($allOrders, $order);
            $grandTotal +=  $total_price;
            // return $allOrders;
        }
        return view('purchaseOrder.purchasePrintPage', compact('orderDate', 'supplier', 'allOrders', 'grandTotal', 'order_no'));
    }
}
