<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function dashboard()
    {


      return view('AdminView.dashboard');

    }
}
