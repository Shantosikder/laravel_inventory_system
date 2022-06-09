<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Supplier;

class supplierController extends Controller
{
    public function supplier($id = "")
    {
        $suppliers = Supplier::get();
        $supplier = null;
        if ($id !== "") {
            $supplier = Supplier::findOrFail($id);
        }
        return view('supplier.supplier', compact('suppliers', 'supplier'));
    }

    public function supplierPost(Request $data, $id = "")
    {
        $data->validate([
            'name' => 'required',
            'company_name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);

        if ($id !== "") {

            $data->validate([
                'opening_due' => 'required',
            ]);
            Supplier::findOrFail($id)->update([
                'name' => $data->name,
                'company_name' => $data->company_name,
                'mobile' => $data->mobile,
                'address' => $data->address,
                'opening_due' => $data->opening_due,
                'status' => $data->status
            ]);
            return back()->with('success', 'Supplier successfully updated');
        }
        Supplier::insert([
            'name' => $data->name,
            'company_name' => $data->company_name,
            'mobile' => $data->mobile,
            'address' => $data->address,
            'status' => $data->status
        ]);
        return back()->with('success', 'Supplier successfully added');
    }
}
