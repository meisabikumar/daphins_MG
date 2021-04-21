<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FootballController extends Controller
{
    //Function to view the football create page and select data from database to display in the options
    public function create(){

        $res = DB::select('select * from football_contests');
        return view('AdminView.football.createcontest', compact('res'));
    }
}
