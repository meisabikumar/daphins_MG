<?php

namespace App\Http\Controllers\AdminController\Cricket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\AdminModel\Cricket\cricket_contest;
use App\Models\CricModel\CricModel;
class Cricket_Contest_Controller extends Controller
{
    //
    public function index()
    {
        //
        $result = cricket_contest::all();
        return view('AdminView.show_cric_contest')->with('result',$result);
    }

    public function store(Request $req)
    {

        $is_free = $req->is_free;
        $contest_category = $req->category;
        $contest_name = $req->name;

        $min_entry = $req->min_entry;
        $max_entry =  $req->max_entry;
        $contest_name = $req->contest_name;
        $match = $req->match;
        // $match_id = DB::table('unique_matchs')->where('match_name', $match)->pluck('match_key');

        $is_confirmed = $req->is_confirmed;
        $is_clonable = $req->is_clonable;
        $is_featured = $req->is_featured;
        $entry_per_user = $req->entry_per_user;
        // $from = $req->from;
        // return $from;
        if($is_free == 1){
            $entry_fee = 0;
            $admin_per = null;
            $admin_amt = null;
            $winning_amt = 0;
            $prize_breakdown = null;
        }
        else{
        if (!empty($req->from)) {

            $from = $req->from;
            $prize_breakdown = array();
            for ($i = 0; $i <= count($from) - 1; $i++) {
                if($from[$i] == 0){
                    continue;
                }
                else{
                $breakdown['from'] = intval($req->from[$i]);
                $breakdown['to'] = $req->to[$i];

                if ($req->prize_type == "per") {
                    $breakdown['prize_per'] = intval($req->percent[$i]);
                } else {
                    $breakdown['prize_per'] = null;
                }
                $breakdown['prize_amt'] = intval($req->amount[$i]);
                $breakdown['amt_per_person'] = intval($req->person[$i]);
                $prize_breakdown[] = $breakdown;
                }
            }
            $winning_amt = intval($req->breakdown_amt);
            $admin_per = intval($req->admin_per);
            // $admin_fix = intval($req->admin_fix);
            $admin_amt = intval($req->admin_fix);
            // $status = 1;
            // $breakdown_amt = intval($req->breakdown_amt);
            // $amt_type = intval($req->amt_type);
            $entry_fee = intval($req->entry_fee);
            $prize_breakdown = json_encode($prize_breakdown);

        }
        }

        DB::table('cricket_contests')->insert([
            'match_id' => $match,
            'contest_name' => $contest_name,
            'game_type' => 'Cricket',
            'category' => $contest_category,
            'entry_per_user' => $entry_per_user,
            'entry_fee' => $entry_fee,
            'min_entry' => $min_entry,
            'max_entry' => $max_entry,
            'admin_per' => $admin_per,
            'admin_amt' => $admin_amt,
            'winning_amt' => $winning_amt,
            'is_featured' => $is_featured,
            'game_status' => 1,
            'is_confirmed' => $is_confirmed,

            'breakdown' => $prize_breakdown,
            'is_free' => $is_free
        ]);

        return redirect('/admin/cricket/contest');
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

    public function delete($id){

        DB::delete('delete from cricket_contests where id = ?',[$id]);
        return redirect('/admin/cricket/contest');
    }
    public function cancel($id){
        DB::update('update cricket_contests set game_status = ?  where id=?',[0, $id]);
        $contest_data = DB::table('cricket_contests')->where('id',$id)->get();
        foreach($contest_data as $cd){
            // return $cd
            $entry_fee = $cd->entry_fee;
            $user_data = DB::table('user_contests')->where(array('contest_id'=> $id, 'game_type' => 'cricket'))->get();
            if(!empty($user_data)){
            foreach($user_data as $ud){
                $user_id = $ud->user_id;
                $user_wallet = DB::table('users')->where('id', $user_id)->get();
                foreach($user_wallet as $uw){
                    $wallet_amount = $uw->wallet;
                    $new_wallet_amount = $wallet_amount + $entry_fee;
                    DB::table('users')->where('id', $user_id)->update(array('wallet'=> $new_wallet_amount));
                    DB::table('transaction_details')->insert(array(
                        'user_id' => $user_id,
                        'amount' => $entry_fee,
                        'status' => 'refunded'
                    ));
                }
            }
        }
        }
        return redirect('/admin/cricket/contest');
    }
    public function editContestCategory($id)
    {
        // $result =  DB::table('football_contests')->where('match_id', $id);
        $result =  DB::select('select * from cricket_contests where id = ?', [$id]);
        // print_r($result);
        if (empty($result)) {
            return Redirect::to('/admin/cricket/contest');
        }
        $res=DB::table('contest_categories')->get();
        $res2=DB::table('cricket_fixtures')->get();
        return  View::make('AdminView.cricket.edit', ['res'=>$res,'res2'=>$res2,'result'=>$result, 'id' => $id]);
    }
    public function postUpdate(Request $req, $id){
        $is_free = $req->is_free;
        $contest_category = $req->category;
        $contest_name = $req->name;
        $match_roaster_id = $req->series_id;
        $min_entry = $req->min_entry;
        $max_entry =  $req->max_entry;
        $contest_name = $req->contest_name;
        $match = $req->match;
        // $match_id = DB::table('unique_matchs')->where('match_name', $match)->pluck('match_key');

        $is_confirmed = $req->is_confirmed;
        $is_clonable = $req->is_clonable;
        $is_featured = $req->is_featured;
        $entry_per_user = $req->entry_per_user;

        if($is_free == 1){
            $entry_fee = 0;
            $admin_per = null;
            $admin_amt = null;
            $winning_amt = 0;
            $prize_breakdown = null;
        }
        else{
        if (!empty($req->from)) {

            $from = $req->from;
            $prize_breakdown = array();
            for ($i = 0; $i <= count($from) - 1; $i++) {
                if($from[$i] == 0){
                    continue;
                }
                else{
                $breakdown['from'] = intval($req->from[$i]);
                $breakdown['to'] = $req->to[$i];

                if ($req->prize_type == "per") {
                    $breakdown['prize_per'] = intval($req->percent[$i]);
                } else {
                    $breakdown['prize_per'] = null;
                }
                $breakdown['prize_amt'] = intval($req->amount[$i]);
                $breakdown['amt_per_person'] = intval($req->person[$i]);
                $prize_breakdown[] = $breakdown;
                }
            }
            $winning_amt = intval($req->breakdown_amt);
            $admin_per = intval($req->admin_per);
            // $admin_fix = intval($req->admin_fix);
            $admin_amt = intval($req->admin_fix);
            // $status = 1;
            // $breakdown_amt = intval($req->breakdown_amt);
            // $amt_type = intval($req->amt_type);
            $entry_fee = intval($req->entry_fee);
            $prize_breakdown = json_encode($prize_breakdown);
        }


        }
        DB::table('cricket_contests')->where('id', $id)
            ->update([
            'match_id' => $match,
            'contest_name' => $contest_name,
            'game_type' => 'Football',
            'category' => $contest_category,
            'entry_per_user' => $entry_per_user,
            'entry_fee' => $entry_fee,
            'min_entry' => $min_entry,
            'max_entry' => $max_entry,
            'admin_per' => $admin_per,
            'admin_amt' => $admin_amt,
            'winning_amt' => $winning_amt,
            'is_featured' => $is_featured,
            'game_status' => 1,
            'is_confirmed' => $is_confirmed,
            'breakdown' => $prize_breakdown,
            'is_free' => $is_free,

        ]);
        return redirect('/admin/cricket/contest');
        }

}
