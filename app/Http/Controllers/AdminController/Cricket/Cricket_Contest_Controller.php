<?php

namespace App\Http\Controllers\AdminController\Cricket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\AdminModel\Cricket\cricket_contest;
use App\Models\CricModel\CricModel;
class Cricket_Contest_Controller extends Controller
{
    //
    public function index()
    {
        //
        $result = cricket_contest::all();
        return view('AdminView.show_contest')->with('result',$result);
    }

    public function store(Request $request)
    {

        $data = new cricket_contest;
        $data->match_id = $request->match_id;
        $data->contest_name = $request->contest_name;
        $data->category = $request->category;
        $data->game_type = $request->game_type;
        $data->tagline = $request->tagline;
        $data->start_date = $request->start_date;
        $data->max_remaining_entry = $request->max_remaining_entry;
        $data->entry_per_user = $request->entry_per_user;
        $data->entry_fee = $request->entry_fee;
        $data->min_entry = $request->min_entry;
        $data->max_entry = $request->max_entry;
        $data->admin_per = $request->admin_per;
        $data->admin_amt = $request->admin_amt;
        $data->winning_amt = $request->winning_amt;
        $data->is_free = $request->is_free;
        $data->is_featured = $request->is_featured;
        $data->game_status = $request->game_status;
        $data->is_confirmed = $request->is_confirmed;
        $data->is_cancelled = $request->is_cancelled;
        $data->breakdown = $request->breakdown;
        $data->save();

        return "done";
    }
    
    // Create Cricket Contest view
    public function cric_create()
    {
        $CricModel=new CricModel();
        $res=$CricModel->ContestgetCategory();
        $res2=$CricModel->Contestgetseries();
        // return $res;
        return view('AdminView.cricket.createcontest',['res'=>$res,'res2'=>$res2]);
    }


    



}
