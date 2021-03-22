<?php

namespace App\Http\Controllers\AdminController\Cricket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AdminModel\Cricket\cricket_contest;

class Cricket_Contest_Controller extends Controller
{
    //
    public function store(Request $request)
    {

        $data = new cricket_contest;
        $data->match_id = $request->match_id;
        $data->contest_name = $request->contest_name;
        $data->contest_category = $request->contest_category;
        $data->game_type = $request->game_type;
        $data->entry_fee = $request->entry_fee;
        $data->entry_per_user = $request->entry_per_user;
        $data->min_entry = $request->min_entry;
        $data->max_entry = $request->max_entry;
        $data->breakdown_amt = $request->breakdown_amt;
        $data->is_free = $request->is_free;
        $data->winning_amt = $request->winning_amt;
        $data->is_featured = $request->is_featured;
        $data->save();
    }
}
