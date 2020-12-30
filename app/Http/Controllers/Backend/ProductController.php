<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product; 
use App\Model\Supplier; 
use App\Model\Unit;
use App\Model\Category;
use Auth;

class ProductController extends Controller
{
    public function view(){
    	$data['alldata'] = Product::all();
    	return view('backend.products.view-product',$data);
    }

    public function add(){
    	$data['suppliers'] = Supplier::all();
    	$data['units'] = Unit::all();
    	$data['categories'] = Category::all();
    	return view('backend.products.add-product',$data);
    }
    
    public function store(Request $request){

        $data = new Product();
        $data->create_by  = Auth::user()->id;
        $data->supplier_id = $request->supplier_id;
        $data->unit_id = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->quantity = '0';
        $data->name = $request->name;
        $data->save();
    	return redirect()->route('products.view')->with('success',' Data Inserted Successful');
    }

    public function edit($id){
    	$data['editData'] = Product::find($id);
    	$data['suppliers'] = Supplier::all();
    	$data['units'] = Unit::all();
    	$data['categories'] = Category::all();
    	return view('backend.products.edit-products',$data);
    }

    public function update(Request $request,$id){

        $data = Product::find($id);
        $data->update_by   = Auth::user()->id;
        $data->category_id = $request->category_id ;
        $data->unit_id     = $request->unit_id;
        $data->supplier_id = $request->supplier_id;
        $data->name 	   = $request->name;
        $data->save();

        return redirect()->route('products.view')->with('success','Data Update Successful');
    }

    public function delete(Request $request){
    	$delete_data = Product::find($request->id);
        $delete_data->delete();
    	return redirect()->back()->with('success','Data Delete Successful');
    }
}
