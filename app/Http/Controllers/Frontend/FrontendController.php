<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class FrontendController extends Controller
{
    // home
    public function index(){
    	return view('auth.login');
    }
    
}
