<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Dashboard view
    public function dashboard()
    {


      return view('AdminView.dashboard');

    }
    // App User view
    public function app_users()
    {
      return view('AdminView.appuserview');
    }

    public function downloadapp(Request $request)
    {
        $mobile_num=$request->post('msisdn');
        // $product=$request->post('product');
        $validity_from="2021-04-07";
        $validity_to="2022-04-07";
        // $mobile_num=12345678;
        // echo gettype($mobile_num);
        if(strlen($mobile_num)>7)
        {
          
            return view('AdminView.Downloadapk');
        }else
        {
            return view('AdminView.unauthenticated');
        }

    
}
}