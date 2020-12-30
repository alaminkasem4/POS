<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Model\Category; 
use Auth;

class CategoryController extends Controller
{
    public function view(){
    	$data['alldata'] = Category::all();
    	return view('backend.categories.view-category',$data);
    }

    public function add(){
    	return view('backend.categories.add-category');
    }
    
     public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required|unique:categories,name' ]);

        $data = new Category();
        $data->create_by  = Auth::user()->id;
        $data->name = $request->name;
        $data->save();
    	return redirect()->route('categories.view')->with('success',' Data Inserted Successful');
    }

    public function edit($id){
    	$editData = Category::find($id);
    	return view('backend.categories.edit-category',compact('editData'));
    }

    public function update(CategoryRequest $request,$id){

        $data = Category::find($id);
        $data->update_by  = Auth::user()->id;
        $data->name       = $request->name;
        $data->save();
        return redirect()->route('categories.view')->with('success','Data Update Successful');
    }

    public function delete(Request $request){
    	$delete_data = Category::find($request->id);
        $delete_data->delete();
    	return redirect()->back()->with('success','Data Delete Successful');
    }
}
