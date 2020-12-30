<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
use App\Model\Unit; 
use Auth;

class UnitController extends Controller
{
    public function view(){
    	$data['alldata'] = Unit::all();
    	return view('backend.units.view-unit',$data);
    }

    public function add(){
    	return view('backend.units.add-unit');
    }
    
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required|unique:units,name' ]);

        $data = new Unit();
        $data->create_by  = Auth::user()->id;
        $data->name = $request->name;
        $data->save();
    	return redirect()->route('units.view')->with('success',' Data Inserted Successful');
    }

    public function edit($id){
    	$editData = Unit::find($id);
    	return view('backend.units.edit-unit',compact('editData'));
    }

    public function update(UnitRequest $request,$id){

        $data = Unit::find($id);
        $data->update_by  = Auth::user()->id;
        $data->name       = $request->name;
        $data->save();

        return redirect()->route('units.view')->with('success','Data Update Successful');
    }

    public function delete(Request $request){
    	$delete_data = Unit::find($request->id);
        $delete_data->delete();
    	return redirect()->back()->with('success','Data Delete Successful');
    }
}
