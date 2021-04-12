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
    
}
