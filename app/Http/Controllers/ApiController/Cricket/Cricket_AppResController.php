<?php

namespace App\Http\Controllers\ApiController\Cricket;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\Cricket\cricket_contest;
use App\Models\ApiModel\Cricket\cricket_fixture;
use App\Models\ApiModel\Cricket\cricket_fixture_teams;
use Illuminate\Http\Request;
use App\Models\ApiModel\Cricket\CricMatch;


class Cricket_AppResController extends Controller
{
    //

    public function MatchDataRes()
    {

        ini_set('max_execution_time', '120');

        $data = cricket_fixture::all();

        
        $result = array();

        foreach ($data as $val) {

            // echo $val;

            $visitorteam = cricket_fixture_teams::where('team_id', $val->visitorteam_id)->first();
            $localteam = cricket_fixture_teams::where('team_id', $val->localteam_id)->first();
            
            $arr = array(
                "id" => $val->id,
                "fixture_id" => $val->fixture_id,               
                "title" => $visitorteam->name . " Vs " . $localteam->name,
                "short_title" => $visitorteam->code . " Vs " . $localteam->code,
                "type" => $val->type,
                "start_date" => $val->starting_at,

                "teams" => array(
                    array(
                         "team_id" => $visitorteam->id,
                        "name" => $visitorteam->name,
                        "short_name" => $visitorteam->code,
                        "flag" => $visitorteam->image_path),
                    array(
                       "team_id" => $localteam->id,
                        "name" => $localteam->name,
                        "short_name" => $localteam->code,
                        "flag" => $localteam->image_path)),

            );

            
        //     // // print_r($arr); 
                       $result[] = $arr;
        }
        // // // var_dump($result);
        $result_json = json_encode($result);

        return response()->json([
            "status" => 1,
            "message" => "Success",
            "result" => $result,
        ]);
    }
    public function cricket_match()
    {
        $CricMatch=new CricMatch();
        $result=[];
        $data = cricket_fixture::all();
        foreach ($data as $value) {
            // local team data
            $localteam=$CricMatch->getlocalteam($value->localteam_id);
            $visitorteam=$CricMatch->getvisitorteam($value->visitorteam_id);
            // echo $localteam;
            
            foreach ($localteam as $teamone) {
                // echo $teamtwo->name."<br>";
            }
            
            
            foreach ($visitorteam as $teamtwo) {
                // echo $teamtwo->name."<br>";
            }
            $data=array("id"=>$value->id,
                "fixture_id"=>$value->fixture_id,
                "title" =>$teamone->name." VS ". $teamtwo->name,
                "short_title" => $teamone->code." Vs ".$teamtwo->code,
                "type" => $value->type,
                "start_date" => $value->starting_at,
                "teams" => array(
                    array(
                         "team_id" => $teamone->id,
                        "name" => $teamone->name,
                        "short_name" => $teamone->code,
                        "flag" => $teamone->image_path),
                    array(
                       "team_id" => $teamtwo->id,
                        "name" => $teamtwo->name,
                        "short_name" => $teamtwo->code,
                        "flag" => $teamtwo->image_path)),
            );
            
            $result[]=$data;
            // echo $value->localteam_id."<br>";
            // visitor team data
            // echo $value->visitorteam_id."<br>";
        }
        
        // $result_json = json_encode($result);
        if($result)
        {
            return response()->json(["status" => 200,"message" => "Success","result" => $result]);
        }
        else{
            return response()->json(["status" => 500,"message" => "Error in data","result" => $result]);
        }
        
        
    }

    public function cricket_get_team_by_match_id(Request $request)
    {

        $teams = cricket_fixture_teams::where("fixture_id", $request->match_id)->get();
        $data = array();

        foreach ($teams as $team) {

            $team_data = array(
                "id" => $team->id,
                "match_id" => $team->team_id,
                "team_id" => $team->fixture_id,
                "team_name" => $team->name,
                "team_short_name" => $team->code,
                "logo_path" => $team->image_path,
            );

            $players = array();

            foreach ($team->players as $player) {

                // return $player;
                $player = array(
                    "player_id" => $player["id"],
                    "team_id" => $team->fixture_id,
                    "team_code" => $team->code,
                    "short_name" => null,
                    "name" => $player["fullname"],
                    "type" => $player["position"]["name"],
                    "logo_path" => $player["image_path"],
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

        return response()->json([
            "status" => 1,
            "message" => "Success",
            "result" => $data,
        ]);
    }

    public function get_cricket_contest_response(Request $request)
    {

       $data = cricket_contest::where('match_id', $request->match_id)->first();


        if (!$data) {
            return response()->json([
                "message" => "No Contest Available",
            ]);
        }

        $match = cricket_fixture::where('fixture_id', $request->match_id)->first();

        $visitorteam = cricket_fixture_teams::where('team_id', $match->visitorteam_id)->first();
        $localteam = cricket_fixture_teams::where('team_id', $match->localteam_id)->first();

        $series_data = array(
            "id" => $match->id,
            "fixture_id" => $match->fixture_id,
            "title" => $visitorteam->name . " Vs " . $localteam->name,
            "short_title" => $visitorteam->code . " Vs " . $localteam->code,
            "type" => $match->type,
            "start_date" => $match->starting_at,

            "teams" => array(
                array(
                    "team_id" => $visitorteam->team_id,
                    "name" => $visitorteam->name,
                    "flag" => $visitorteam->image_path),
                array(
                    "team_id" => $localteam->team_id,
                    "name" => $localteam->name,
                    "flag" => $localteam->image_path)),

        );

        return response()->json([
            "status" => 1,
            "message" => "Success",
            "result" => [$data],
            "series_data" => $series_data,
        ]);

    }
    public function cricket_players()
    {
        $CricMatch=new CricMatch();
        $result_team=$CricMatch->getplayer_cric();
        foreach ($result_team as $value) {
            $value->players;
            
        }   

    }
    public function userJoin_contest(Request $request)
    {
        $user_id=$request->input('user_id');
        $contest_id=$request->input('contest_id');
        $CricMatch=new CricMatch();
        $contest_detail=$CricMatch->contest_detail_model($contest_id);
        foreach ($contest_detail as $value) {
            $match_id=$value->match_id;
            $game_type=$value->game_type;
            $entry_fee=$value->entry_fee;
        }
        $data=array(
            'user_id'=>$user_id,
            'contest_id'=>$contest_id,
            'match_id'=>$match_id,
            'game_type'=>$game_type,
            'entry_fee'=>$entry_fee
        );
        $result_usercontest=$CricMatch->usercontestModel($data);
        
        if($result_usercontest>0)
        {
            return response()->json(["status" => 1,"message" => "Success"]);
        }else
        {
            return response()->json(["status" => 2,"message" => "Error"]);
        }
    }

}
