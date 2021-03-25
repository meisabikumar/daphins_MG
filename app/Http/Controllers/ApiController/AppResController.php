<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\Football\football_contest;
use App\Models\ApiModel\football\roanuz\roanuz_match_teams;
use App\Models\ApiModel\football\sportsmonk\sportsmonk_match_teams;
use App\Models\ApiModel\football\unique_data\unique_matchs;
use App\Models\ApiModel\football\unique_data\unique_teams;
use App\Models\ApiModel\MatchesModel;
use App\Models\ApiModel\PlayerModel;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppResController extends Controller
{

    public function FixtureRes()
    {
        $MatchesModel = new MatchesModel();
        $res = $MatchesModel->getTeamOne_Model();
        $resobj = json_encode($res);
        return $resobj;
    }
    public function TeamRes()
    {
        $MatchesModel = new MatchesModel();
        $res = $MatchesModel->TeamData();
        $resobj = json_encode($res);
        return $resobj;
    }
    public function PlayerRes()
    {
        $PlayerModel = new PlayerModel();
        $res = $PlayerModel->PlayerData();
        $resobj = json_encode($res);
        return $resobj;
    }

    public function MatchDataRes()
    {
        $data = unique_matchs::all();

        $result = array();

        foreach ($data as $val) {

            if ($val->API == 'roanuz') {

                $visitorteam = roanuz_match_teams::where('team_key', $val->match_away_team)->first();
                $localteam = roanuz_match_teams::where('team_key', $val->match_home_team)->first();

                $teams = array(
                    array(
                        "id" => $visitorteam->id,
                        "team_id" => $visitorteam->team_key,
                        "name" => $visitorteam->team_name,
                        "short_name" => $visitorteam->team_short_name,
                        "flag" => null),
                    array(
                        "id" => $localteam->id,
                        "team_id" => $localteam->team_key,
                        "name" => $localteam->team_name,
                        "short_name" => $localteam->team_short_name,
                        "flag" => null));
            }

            if ($val->API == 'sportsmonk') {
                // return  $val->match_away_team;
                $visitorteam = sportsmonk_match_teams::where('team_id', $val->match_away_team)->first();
                $localteam = sportsmonk_match_teams::where('team_id', $val->match_home_team)->first();

                $teams = array(
                    array(
                        "id" => $visitorteam->id,
                        "team_id" => $visitorteam->teamId,
                        "name" => $visitorteam->name,
                        "short_name" => $visitorteam->short_code,
                        "flag" => $visitorteam->logo_path),
                    array(
                        "id" => $localteam->id,
                        "team_id" => $localteam->teamId,
                        "name" => $localteam->name,
                        "short_name" => $localteam->short_code,
                        "flag" => $localteam->logo_path));
            }

            $arr = array(
                "id" => $val->id,
                "match_key" => $val->match_key,
                "title" => $val->match_name,
                "short_title" => $val->match_short_name,
                "start_date" => $val->match_start_date . " " . $val->match_start_time,
                "type" => $val->tournament_name,
                "teams" => $teams,
                "API" => $val->API);

            $result[] = $arr;
        }

        return response()->json([
            "status" => 1,
            "message" => "Success",
            "result" => $result,
        ]);

    }

    public function football_get_team_by_match_id(Request $request)
    {
        $teams = unique_teams::where('match_key', $request->match_id)->get();

        $data = array();

        foreach ($teams as $team) {

            if ($team->API == 'sportsmonk') {

                $team_data = array(
                    "id" => $team->id,
                    "match_id" => $team->match_key,
                    "team_id" => $team->team_key,
                    "team_name" => $team->team_name,
                    "team_short_name" => $team->team_short_name,
                    "logo_path" => $team->logo_path,
                );

                $players = array();

                foreach ($team->players as $player) {

                    $player = array(
                        "player_id" => $player["player_id"],
                        "team_id" => $player["team_id"],
                        "team_code" => $team->team_short_name,
                        "short_name" => $player["common_name"],
                        "name" => $player["fullname"],
                        "player_points" => "22",
                        "player_credits" => "8.5",
                        "sel_by" => "21.16",
                    );

                    $players[] = $player;
                }

                $data[] = array(
                    "team_data" => $team_data,
                    "players" => $players,
                );

            }

            if ($team->API == 'roanuz') {

                $team_data = array(
                    "id" => $team->id,
                    "match_id" => $team->match_key,
                    "team_id" => $team->team_key,
                    "team_name" => $team->team_name,
                    "team_short_name" => $team->team_short_name,
                    "logo_path" => $team->logo_path,
                );

                $players = array();

                foreach ($team->players as $player) {

                    $player = array(
                        "player_id" => $player["key"],
                        "team_id" => $team->team_key,
                        "team_code" => $team->team_short_name,
                        "short_name" => $player["jersey_name"],
                        "name" => $player["name"],
                        "player_points" => "22",
                        "player_credits" => "8.5",
                        "sel_by" => "21.16",
                    );

                    $players[] = $player;
                }

                $data[] = array(
                    "team_data" => $team_data,
                    "players" => $players,
                );

            }

        }

        return response()->json([
            "status" => 1,
            "message" => "Success",
            "result" => $data,
        ]);

    }

    public function football_contest_response(Request $request)
    {
        $data = football_contest::where('match_id', $request->match_id)->get();

        if (!$data) {
            return response()->json([
                "message" => "No Contest Available",
            ]);
        }

        $match = unique_matchs::where('match_key', $request->match_id)->first();

        if ($match->API == 'roanuz') {
            $visitorteam = roanuz_match_teams::where('team_key', $match->match_away_team)->first();
            $localteam = roanuz_match_teams::where('team_key', $match->match_home_team)->first();

            $teams = array(
                array(
                    "id" => $visitorteam->id,
                    "team_id" => $visitorteam->team_key,
                    "name" => $visitorteam->team_name,
                    "short_name" => $visitorteam->team_short_name,
                    "flag" => null),
                array(
                    "id" => $localteam->id,
                    "team_id" => $localteam->team_key,
                    "name" => $localteam->team_name,
                    "short_name" => $localteam->team_short_name,
                    "flag" => null));
        }

        if ($match->API == 'sportsmonk') {
            // return  $val->match_away_team;
            $visitorteam = sportsmonk_match_teams::where('teamId', $match->match_away_team)->first();
            $localteam = sportsmonk_match_teams::where('teamId', $match->match_home_team)->first();

            $teams = array(
                array(
                    "id" => $visitorteam->id,
                    "team_id" => $visitorteam->teamId,
                    "name" => $visitorteam->name,
                    "short_name" => $visitorteam->short_code,
                    "flag" => $visitorteam->logo_path),
                array(
                    "id" => $localteam->id,
                    "team_id" => $localteam->teamId,
                    "name" => $localteam->name,
                    "short_name" => $localteam->short_code,
                    "flag" => $localteam->logo_path));
        }

        $series_data = array(
            "id" => $match->id,
            "match_key" => $match->match_key,
            "title" => $match->match_name,
            "short_title" => $match->match_short_name,
            "start_date" => $match->match_start_date . " " . $match->match_start_time,
            "type" => $match->tournament_name,
            "teams" => $teams,
            "API" => $match->API);

        return response()->json([
            "status" => 1,
            "message" => "Success",
            "result" => $data,
            "series_data" => $series_data,
        ]);
    }

}
