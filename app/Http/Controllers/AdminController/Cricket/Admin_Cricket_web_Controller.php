<?php

namespace App\Http\Controllers\AdminController\Cricket;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\Cricket\cricket_fixture_player_credits_by_admin;
use App\Models\ApiModel\Cricket\cricket_fixture;
use App\Models\ApiModel\Cricket\cricket_fixture_teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin_Cricket_web_Controller extends Controller
{
    //
    public function all_matchs()
    {
        $data = DB::table('cricket_fixtures')->get();
        return view('AdminView.cricket.all_match')->with('match', $data);
    }

    public function update_active(Request $request)
    {
        // print_r($request);
        DB::table('cricket_fixtures')->where(array('fixture_id'=> $request->match_id))->update(['active' => 1]);
        return redirect(url('/admin/cricket/all_matchs'));
    }

    public function update_inactive(Request $request)
    {
        cricket_fixture::where('fixture_id', $request->match_id)->update(['active' => 0]);
        return redirect()->back();
    }

    public function get_player(Request $request, $match_id)
    {
       $teams = cricket_fixture_teams::where('fixture_id', $match_id)->get();


        $feed = cricket_fixture_player_credits_by_admin::where('match_id', $match_id)->firstOr(function () use ($teams,$match_id) {

            foreach ($teams as $team) {

                foreach ($team['players'] as $key => $player) {

                    cricket_fixture_player_credits_by_admin::firstOrCreate(

                        ['match_id' => $match_id,'player_id' => $player['id']],
                        ['match_id' => $match_id,
                        'team_id' => $team['team_id'],
                        'team_name' => $team['name'],
                        'player_id' => $player['id'],
                        'player_name' => $player['fullname'],
                        'position' => $player['position']['name']
                        ]
                    );

                }

            }

        });

        $f = cricket_fixture_player_credits_by_admin::where('match_id',$match_id)->get();

        return view('AdminView.cricket.assign_players_credit')->with('teams', $teams);
    }

    public function assign_player_credit(Request $request, $match_id)
    {

        $request->player;
        $team1 = $request->player[0];
        $team2 = $request->player[1];

        foreach ($team1 as $team_id => $team_data) {

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
