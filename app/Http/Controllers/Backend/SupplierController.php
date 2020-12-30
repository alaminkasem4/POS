<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;
use App\Model\Supplier; 
use Auth;

class SupplierController extends Controller
{
    public function view(){
    	$data['alldata'] = Supplier::all();
    	return view('backend.suppliers.view-supplier',$data);
    }

    public function add(){
    	return view('backend.suppliers.add-supplier');
    }
    
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
            'mobile'   =>'required|unique:suppliers|max:11|min:11',
            'address'   =>'required',
        ]);

        $data = new Supplier();
        $data->create_by  = Auth::user()->id;
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
    	return redirect()->route('suppliers.view')->with('success',' Data Inserted Successful');
    }

    public function edit($id){
    	$editData = Supplier::find($id);
    	return view('backend.suppliers.edit-supplier',compact('editData'));
    }

    public function update(SupplierRequest $request,$id){

        $data = Supplier::find($id);
        $data->update_by  = Auth::user()->id;
        $data->name       = $request->name;
        $data->mobile     = $request->mobile;
        $data->email 	  = $request->email;
        $data->address 	  = $request->address;
        $data->save();

        return redirect()->route('suppliers.view')->with('success','Data Update Successful');
    }

    public function delete(Request $request){
    	$delete_data = Supplier::find($request->id);
        $delete_data->delete();
    	return redirect()->back()->with('success','Data Delete Successful');
    }
}
