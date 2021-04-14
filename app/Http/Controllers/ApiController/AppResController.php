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
                // echo $val->match_away_team.'<br>';
                $roanuz_match_teams=new roanuz_match_teams();
                $visitorteam=$roanuz_match_teams->getVisitor($val->match_away_team);
                $localteam = $roanuz_match_teams->getLocal($val->match_home_team);
                foreach ($localteam as $teamone) {
                    // echo $teamtwo->name."<br>";
                }
                
                
                foreach ($visitorteam as $teamtwo) {
                    // echo $teamtwo->name."<br>";
                    // echo $teamtwo->id;
                }
                $teams = array(
                        array(
                        "id" => $teamtwo->id,
                        "team_id" => $teamtwo->team_key,
                        "name" => $teamtwo->team_name,
                        "short_name" => $teamtwo->team_short_name,
                        "flag" => null),
                        array(
                        "id" => $teamone->id,
                        "team_id" => $teamone->team_key,
                        "name" => $teamone->team_name,
                        "short_name" => $teamone->team_short_name,
                        "flag" => null)
                    );
                     
                } 
            

            if ($val->API == 'sportsmonk') {
                // return  $val->match_away_team;
                $sportsmonk_match_teams=new sportsmonk_match_teams();
                $visitorteam=$sportsmonk_match_teams->newgetvisitor($val->match_away_team);
                $localteam=$sportsmonk_match_teams->newgetLocal($val->match_home_team);
                // $visitorteam = sportsmonk_match_teams::where('team_id', $val->match_away_team)->first();
                // $localteam = sportsmonk_match_teams::where('team_id', $val->match_home_team)->first();
                foreach ($visitorteam as $teamtwo) {
                    
                }
                foreach ($localteam as $teamone) {
                    # code...
                }
                $teams = array(
                    array(
                        "id" => $teamtwo->id,
                        "team_id" => $teamtwo->team_id,
                        "name" => $teamtwo->name,
                        "short_name" => $teamtwo->short_code,
                        "flag" => $teamtwo->logo_path),
                    array(
                        "id" => $teamone->id,
                        "team_id" => $teamone->team_id,
                        "name" => $teamone->name,
                        "short_name" => $teamone->short_code,
                        "flag" => $teamone->logo_path));
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
    // Football Team
    // public function getFootballTeam(Request $request)
    // {

    // }
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
                        "type" => null,
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
                        "type" => $player["role"],
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
            "result" => $teams,
        ]);

    }

    public function get_football_contest_response(Request $request)
    {
        $data = football_contest::where('match_id', $request->match_id)->first();

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
            "result" => [$data],
            "series_data" => $series_data,
        ]);
    }
    // Football User Team Create and Get
    public function Football_User_Teams(Request $request)
    {
        $user_id=$request->post('user_id');
        
        $team[]=$request->post('team');
        $match_id=$request->post('match_id');
        // $data=array(
        //     'user_id'=>$request->post('user_id'),
        //     'teams'=>$team[],
        //     // return $team;
        // );
        $team_json=json_encode($team);
        // return $team;
        // return gettype($team);
        // return gettype($team_json);
        // return $team;
        $CricMatch=new CricMatch();
        $res_user_team=$CricMatch->Football_User_Teams_Model($user_id,$team_json,$match_id);
        // return $data;
        
        
        // return response()->json(["status" => 1,"message" => "Success"]);
        


    }
    public function Football_Teams_get(Request $request)
    {
        // $user_id=1;
        // $match_id=24915;
        $user_id=$request->post('user_id');
        $match_id=$request->post('match_id');
        $CricMatch=new CricMatch();
        // return $match_id;
        $res=$CricMatch->Football_Teams_Model_get($user_id,$match_id);
        // return $res;
        foreach ($res as $value) {
            // $user_id=$value->user_id;
            $id=$value->id;
            $match_id=$value->match_id;
            $team=stripslashes($value->teams);
            $team_id=json_decode($team);
            
            $data=array("team_id"=>$id,"user_id"=>$user_id,"match_id"=>$match_id,"team"=>$team_id);
            
            
            $result[]=$data;

        }
        return response()->json(["status" => 1,"message" => "Success","data"=>$result]);
        
    }

}
