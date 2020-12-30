<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\NewsEvent; 
use Auth;
class NewsEventController extends Controller
{
    public function view(){
    	$data['alldata'] = NewsEvent::all();
    	return view('backend.newsEnents.view-newsEvent',$data);
    }

    public function add(){
    	return view('backend.newsEnents.add-newsEvent');
    }
    
    public function store(Request $request){

        $data = new NewsEvent();
        $data->create_by  = Auth::user()->id;
        $data->date = $request->date;
        $data->short_text = $request->short_text;
        $data->long_text = $request->long_text;
    	if($request->file('image')){
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/newsEvents_img/'),$filename);
            $data['image'] = $filename;
        }
        $data->save();
    	return redirect()->route('news_events.view')->with('success',' NewsEvents Data Inserted Successful');
    }

    public function edit($id){
    	$editnewsEvent = NewsEvent::find($id);
    	return view('backend.newsEnents.edit-newsEvent',compact('editnewsEvent'));
    }

    public function update(Request $request,$id){
        $data = NewsEvent::find($id);
        $data->update_by  = Auth::user()->id;
        $data->date       = $request->date;
        $data->short_text = $request->short_text;
        $data->long_text  = $request->long_text;
    
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/newsEvents_img/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/newsEvents_img/'),$filename);
            $data['image'] = $filename;
        }
        $data->save();
        return redirect()->route('news_events.view')->with('success','NewsEvents Update Successful');
    }

    public function delete(Request $request){
    	$newEvent = NewsEvent::find($request->id);
    	if(file_exists('upload/newsEvents_img/'.$newEvent->image) AND ! empty($newEvent->image)){
    		unlink('upload/newsEvents_img/'.$newEvent->image);
    	}
        $newEvent->delete();
    	return redirect()->back()->with('success','Data Delete Successful');
    }

}
