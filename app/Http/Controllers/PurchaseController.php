<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Unit;

class PurchaseController extends Controller
{
    public function purchase($id = "")
    {
        $purchases = Purchase::get();
        $units = Unit::all();
        $purchase = null;
        if ($id !== "") {
            $purchase = Purchase::findOrFail($id);
        }
        return view('purchase.purchase', compact('purchases', 'purchase', 'units'));
    }

    public function purchasePost(Request $data, $id = "")
    {
        $data->validate([
            'name' => 'required',
            'unit' => 'required',
            'code' => 'required',
            'describtion' => 'required',
            'status' => 'required',
        ]);

        if ($id !== "") {

            // $data->validate([
            //     'opening_due' => 'required',
            // ]);
            Purchase::findOrFail($id)->update([
                'name' => $data->name,
                'unit' => $data->unit,
                'code' => $data->code,
                'describtion' => $data->describtion,
                'status' => $data->status
            ]);
            return back()->with('success', 'Purchases successfully updated');
        }
        Purchase::insert([
            'name' => $data->name,
            'unit' => $data->unit,
            'code' => $data->code,
            'describtion' => $data->describtion,
            'status' => $data->status
        ]);
        return back()->with('success', 'Purchases successfully added');
    }
}
