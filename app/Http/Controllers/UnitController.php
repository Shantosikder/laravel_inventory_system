<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{

     public function addUnit($id = "")
     {
          $units = Unit::get();
          $unit = null;
          if ($id !== "") {
               $unit = Unit::findOrFail($id);
          }
          return view('Units.add_unit', compact('units', 'unit'));
     }

     public function addUnitPost(Request $data, $id = "")
     {
          $data->validate([
               'name' => 'required',
               'status' => 'required',
          ]);

          if ($id !== "") {
               Unit::findOrFail($id)->update([
                    'name' => $data->name,
                    'status' => $data->status,
               ]);
               return back()->with('success', 'Unit successfully updated');
          }
          Unit::insert([
               'name' => $data->name,
               'status' => $data->status,
          ]);
          return back()->with('success', 'Unit successfully added');
     }
}
