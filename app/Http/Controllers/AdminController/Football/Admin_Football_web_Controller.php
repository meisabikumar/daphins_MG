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

}
