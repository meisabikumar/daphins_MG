<?php

namespace App\Http\Controllers\AdminController\Football;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function get_player(Request $request, $match_id)
    {
    //    $teams = cricket_fixture_teams::where('fixture_id', $match_id)->get();
        $teams = DB::table('unique_teams')->where(array('match_key' => $match_id))->get();

        // $feed = cricket_fixture_player_credits_by_admin::where('match_id', $match_id)->firstOr(function () use ($teams,$match_id) {

        //     foreach ($teams as $team) {

        //         foreach ($team['players'] as $key => $player) {

        //             cricket_fixture_player_credits_by_admin::firstOrCreate(

        //                 ['match_id' => $match_id,'player_id' => $player['id']],
        //                 ['match_id' => $match_id,
        //                 'team_id' => $team['team_id'],
        //                 'team_name' => $team['name'],
        //                 'player_id' => $player['id'],
        //                 'player_name' => $player['fullname'],
        //                 'position' => $player['position']['name']
        //                 ]
        //             );

        //         }

        //     }

        // });

        // $f = cricket_fixture_player_credits_by_admin::where('match_id',$match_id)->get();

        return view('AdminView.football.assign_players_credit')->with(array('teams'=> $teams, 'mat_id'=>$match_id));
    }
    public function assign_player_credit(Request $request, $match_id)
    {
        
        $request->player;
        $team1 = $request->player[0];
        $team2 = $request->player[1];
        $data = DB::table('football_match_player_credits_by_admins')->where(array('match_id'=> $match_id))->get();
        if(empty($data)){
            $player_data = DB::table('unique_teams')->where(array('match_key'=>$match_id))->get();
            foreach($player_data as $k){
                $j = json_decode($k->players);
                foreach($j as $i){
                    DB::table('football_match_player_credits_by_admins')->insert(array(

                        'match_i' => $match_id,
                        'team_id' => $k->team_key,
                        'team_name' => $k->team_name,
                        'player_id' => $i->key,
                        'player_name' => $i->name,
                        'position' => $i->role
                    ));
                }
            }
        }
        foreach ($team1 as $team_id => $team_data) {

            foreach ($team_data as $val) {
                // return $val;
                foreach ($val as $player_id => $credit) {
                    // return $player_id;

                    $arr = array(
                        "match_key" => $match_id,
                        "player_id" => $player_id,

                    );

                    DB::table('football_match_player_credits_by_admins')->where($arr)->update(array('credit' => $credit));
                }

            }
            return url('/admin/football/all_matchs');
            // $team1_data = array(
            //     "team_id" => $team_id,
            //     "platers_data" => $platers_data,
            // );

        }

        foreach ($team2 as $team_id => $team_data) {

            // return $team_id;

            foreach ($team_data as $val) {
                // return $val;
                foreach ($val as $player_id => $credit) {
                    // return $player_id;

                    $arr = array(
                        "match_id" => $match_id,
                        "player_id" => $player_id,

                    );

                    DB::table('cricket_fixture_player_credits_by_admins')->where($arr)->update(array('credit' => $credit));
                }

            }

            // $team2_data = array(
            //     "team_id" => $team_id,
            //     "platers_data" => $platers_data,
            // );

        }

        // $data = cricket_fixture_player_credits_by_admin::updateOrCreate(
        //     ['match_id' => $match_id],
        //     ['match_id' => $match_id, 'team_1' => $team1_data, 'team_2' => $team2_data]
        // );

        return redirect()->back();
    }
}
