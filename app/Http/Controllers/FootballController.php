<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\FootballModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
class FootballController extends Controller
{
    //Function to view the football create page and select data from database to display in the options
    public function create(){

        $FootballModel=new FootballModel();
        $res=$FootballModel->ContestgetCategory();
        $res2=$FootballModel->Contestgetseries();
        // return $res;
        return view('AdminView.football.createcontest',['res'=>$res,'res2'=>$res2]);
        // $res = DB::select('select * from football_contests');
        // return view('AdminView.football.createcontest', compact('res'));
    }
    public function editContestCategory($id)
    {
        // $result =  DB::table('football_contests')->where('match_id', $id);
        $result =  DB::select('select * from football_contests where id = ?', [$id]);
        // print_r($result);
        if (empty($result)) {
            return Redirect::to('/admin/football/contest');
        }
        $res=DB::table('contest_categories')->get();
        $res2=DB::table('unique_matchs')->get();
        return  View::make('AdminView.football.edit', ['res'=>$res,'res2'=>$res2,'result'=>$result]);
    }
    public function delete($id){

        DB::delete('delete from football_contests where id = ?',[$id]);
        return redirect('/admin/football/contest');
    }
    public function cancel($id){
        DB::update('update football_contests set game_status = ?  where id=?',[0, $id]);
        return redirect('/admin/football/contest');
    }
    public function add(Request $req){
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

        if (!empty($req->from)) {

            $from = $req->from;
            $prize_breakdown = array();
            for ($i = 0; $i <= count($from) - 1; $i++) {
                $breakdown['from'] = intval($req->from[$i]);
                $breakdown['to'] = intval($req->to[$i]);
                if ($req->prize_type == "per") {
                    $breakdown['prize_per'] = intval($req->percent[$i]);
                } else {
                    $breakdown['prize_per'] = null;
                }
                $breakdown['prize_amt'] = intval($req->amount[$i]);
                $breakdown['amt_per_person'] = intval($req->person[$i]);
                $prize_breakdown[] = $breakdown;
            }

            $winning_amt = intval($req->breakdown_amt);
            $admin_per = intval($req->admin_per);
            $admin_fix = intval($req->admin_fix);
            $admin_amt = intval($req->admin_amt);
            $status = 1;
            $breakdown_amt = intval($req->breakdown_amt);
            $amt_type = intval($req->amt_type);
            $entry_fee = intval($req->entry_fee);
            $prize_breakdown = json_encode($prize_breakdown);


        }
        if($is_free == 1){
            $entry_fee = 0;
            $admin_per = null;
            $admin_amt = null;
            $winning_amt = 0;
            $prize_breakdown = [];
        }
        DB::table('football_contests')->insert([
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
            'is_free' => $is_free
        ]);
        return redirect('/admin/football/contest');
        }
            // return  "test";
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

                if (!empty($req->from)) {

                    $from = $req->from;
                    $prize_breakdown = array();
                    for ($i = 0; $i <= count($from) - 1; $i++) {
                        $breakdown['from'] = intval($req->from[$i]);
                        $breakdown['to'] = intval($req->to[$i]);
                        if ($req->prize_type == "per") {
                            $breakdown['prize_per'] = intval($req->percent[$i]);
                        } else {
                            $breakdown['prize_per'] = null;
                        }
                        $breakdown['prize_amt'] = intval($req->amount[$i]);
                        $breakdown['amt_per_person'] = intval($req->person[$i]);
                        $prize_breakdown[] = $breakdown;
                    }

                    $winning_amt = intval($req->breakdown_amt);
                    $admin_per = intval($req->admin_per);
                    $admin_fix = intval($req->admin_fix);
                    $admin_amt = intval($req->admin_amt);

                    $breakdown_amt = intval($req->breakdown_amt);
                    $amt_type = intval($req->amt_type);
                    $entry_fee = intval($req->entry_fee);
                    $prize_breakdown = json_encode($prize_breakdown);
                    if($is_free == 1){
                        $entry_fee = 0;
                    }


                }
                DB::table('football_contests')->where('id', $id)
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
                return redirect('/admin/football/contest');
                }
    }
