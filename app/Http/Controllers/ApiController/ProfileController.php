<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{

    public function index()
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function update(Request $request)
    {
        //
        $data = User::find($request->user_id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->save();
        return response()->json(['success' =>"Profile Updated","data"=>$data],200);
    }


    public function destroy($id)
    {
        //
    }
}
