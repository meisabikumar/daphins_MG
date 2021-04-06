<?php

namespace App\Http\Controllers\AdminController\Football;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ApiModel\football\unique_data\unique_matchs;

class Admin_Football_web_Controller extends Controller
{
    //

    public function all_matchs(){
        $data = unique_matchs::all();
        return view('AdminView.football.all_match')->with('match',$data);
    }

    public function update_active(Request $request)
    {
        unique_matchs::where('match_key', $request->match_id)->update(['active' => 1]);
        return redirect()->back();
    }

    public function update_inactive(Request $request)
    {
        unique_matchs::where('match_key', $request->match_id)->update(['active' => 0]);
        return redirect()->back();
    }
}
