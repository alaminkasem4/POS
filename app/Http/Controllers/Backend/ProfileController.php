<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{
    //
    public function view(){
    	$id = Auth::user()->id;
    	$data = User::find($id);
    	return view('backend.profile.view-profile',compact('data'));
    }

    public function edit(){
    	$id = Auth::user()->id;
    	$edit = User::find($id);
    	return view('backend.profile.edit-profile',compact('edit'));
    }

    public function update(Request $request){
      /*  $this->validate($request,[
            'name'=>'required',
            'email'    =>'required',
            'mobile'   =>'required',
            'gender'   =>'required',
            'address'   =>'required',
            'image'   =>'required',
        ]);*/
        $id             = Auth::user()->id;
        $data           = User::find($id);
        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->mobile   = $request->mobile;
        $data->gender   = $request->gender;
        $data->address  = $request->address;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_img/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_img/'),$filename);
            $data['image'] = $filename;
        }
        
        $data->save();
        return redirect()->route('profile.view')->with('success','Profile Update Successful');
    }

    public function password_view(){
        return view('backend.profile.change-password');
    }

    public function password_update(Request $request){
        $auth_id = Auth::user()->id; // auth user id
       if(Auth::attempt(['id'=>$auth_id,'password'=>$request->current_password])){
        $user = User::find($auth_id);
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->route('profile.view')->with('success','Your Password Is Change');
       }else{
            return redirect()->back()->with('error','Sorry Your Current Password does not work');
       }

    }



}
