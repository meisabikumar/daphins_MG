<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AdminModel\Cricket\cricket_contest;
use App\Models\AdminModel\Football\football_contest;
use App\Models\User\user_contest;
use App\Models\User\user_wallet_transaction;

class User_Contest_Controller extends Controller
{
    //
    public function join_contest(Request $request)
    {

        if ($request->game_type == "football") {
            $contest = football_contest::where('id', $request->contest_id)->where('match_id', $request->match_id)->first();
        }elseif($request->game_type == "cricket"){
          $contest = cricket_contest::where('id', $request->contest_id)->where('match_id', $request->match_id)->first();
        }

        if (!$contest) {
            return response()->json([
                "message" => "No Contest Available",
            ]);
        }

        if ($contest->max_remaining_entry > 0) {

            $user_contest = user_contest::where('match_id', $request->match_id)->get();
            $user = User::find($request->user_id);

            if ($user_contest->count() < $contest->entry_per_user) {

                if ($contest->is_free == 0) {


                    if ($user->wallet > $contest->entry_fee) {
                        $entry_fee = $contest->entry_fee;
                      $wallet_remaining  = $user->wallet -  $entry_fee ;
                    } else {
                        return "insufficent balance";
                    }

                } else {
                    $entry_fee = 0;
                     $wallet_remaining  = $user->wallet;
                }

                $data = new user_contest;
                $data->user_id = $request->user_id;
                $data->contest_id = $request->contest_id;
                $data->match_id = $request->match_id;
                $data->game_type = $request->game_type;
                $data->entry_fee = $entry_fee;
                $data->players = $request->players;
                $data->save();



                $data  = User::find($request->user_id);
                $data->wallet  = $wallet_remaining;
                $data->save();
                // ->update(['wallet' =>$wallet_remaining]);

                $data = new user_wallet_transaction;
                $data->user_id = $request->user_id;
                $data->contest_id = $request->contest_id;
                $data->match_id = $request->match_id;
                $data->game_type = $request->game_type;
                $data->trans_type = "debit";
                $data->amount = $entry_fee;
                $data->save();

            } else {
                return "entry per user exceed";
            }

        } else {
            return "Contest Full";
        }

        return "sucess";



    }

}
