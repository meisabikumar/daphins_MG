<?php

namespace App\Http\Controllers\ApiController\Cricket;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\Cricket\cricket_contest;
use App\Models\ApiModel\Cricket\cricket_fixture;
use App\Models\ApiModel\Cricket\cricket_fixture_teams;
use Illuminate\Http\Request;
use App\Models\ApiModel\Cricket\CricMatch;
use Illuminate\Support\Facades\Http;
use App\Models\CricUserTeams;
use App\Models\CricPlayerPrice;
use App\Models\CricUserTeamPlayers;
use App\Models\CricPlayers;
use App\Models\CricCountry;
use App\Models\CricUserContest;
use App\Models\CricPlayerStats;
use App\Models\CricTeam;
use App\Models\CricContests;
use App\Models\CricUserContestRank;
use App\Models\CricTournament;
use App\Models\CricketMatches;
use App\Models\CricPlayerPoints;
use App\Models\CricMatchStatus;
use \Carbon\Carbon;
use App\Models\User;
use App\Models\UserWalets;
use Illuminate\Console\Command;
use App\Models\CronRecord;
use DateTime;
use App\Models\AdminModel\Football\football_contest;
use App\Models\ApiModel\football\roanuz\roanuz_match_teams;
use App\Models\ApiModel\football\sportsmonk\sportsmonk_match_teams;
use App\Models\ApiModel\football\unique_data\unique_matchs;
use App\Models\ApiModel\football\unique_data\unique_teams;

use Illuminate\Support\Facades\DB;

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
                    // "player_points" => "22",
                    "player_credits" => "9",
                    // sel_by ko nikalna hai
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

    //    $data = cricket_contest::where('match_id', $request->match_id)->first();
    $data=DB::table('cricket_contests')->where(array("match_id"=>$request->match_id))->get();
    

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
            "result" => $data,
            "series_data" => $series_data,
        ]);

    }
    public function cricket_players()
    {
        $CricMatch=new CricMatch();
        $api_token = "Vs99FDycm6GHwRj4Cr9x67QC8d1S2ShJVQ7crytfZ7DBhrI4FFM1irajfKv3";

        $fixtures = cricket_fixture::get();

        cricket_fixture_teams::truncate();

        foreach ($fixtures as $fixture) 
        {
            

            $teamone_id=$fixture->localteam_id;
            $seasson_id=$fixture->season_id;
            // echo $teamid."<br>";
            
            $localteam ="https://cricket.sportmonks.com/api/v2.0/teams/".$teamone_id."/squad/".$seasson_id."?api_token=".$api_token;
            // $localteam = "https://cricket.sportmonks.com/api/v2.0/teams/".$fixture['localteam_id']."?api_token=".$api_token."&include=squad";

            $localteam_res = Http::get($localteam);
            $localteam_data = $localteam_res["data"];
            // return $localteam_data;
            $data = new cricket_fixture_teams;
            $data->team_id = $localteam_data["id"];
            $data->fixture_id = $fixture->fixture_id;
            $data->name = $localteam_data["name"];
            $data->code = $localteam_data["code"];
            $data->image_path = $localteam_data["image_path"];
            $data->country_id = $localteam_data["country_id"];
            $data->national_team = $localteam_data["national_team"];
            $data->players = $localteam_data["squad"];
            $data->save();
        

            // ------------ ---------------------
            $teamtwo_id=$fixture->visitorteam_id;
            $visitorteam ="https://cricket.sportmonks.com/api/v2.0/teams/".$teamtwo_id."/squad/".$seasson_id."?api_token=".$api_token;
        //     $visitorteam = "https://cricket.sportmonks.com/api/v2.0/teams/" . $fixture['visitorteam_id'] . "?api_token=" . $api_token . "&include=squad";

            $visitorteam_res = Http::get($visitorteam);
            $visitorteam_data = $visitorteam_res["data"];

            $data = new cricket_fixture_teams;
            $data->team_id = $visitorteam_data["id"];
            $data->fixture_id = $fixture->fixture_id;
            $data->name = $visitorteam_data["name"];
            $data->code = $visitorteam_data["code"];
            $data->image_path = $visitorteam_data["image_path"];
            $data->country_id = $visitorteam_data["country_id"];
            $data->national_team = $visitorteam_data["national_team"];
            $data->players = $visitorteam_data["squad"];
            $data->save();
            
        }

        return response()->json([
            "status" => 1,
            "message" => "Success",
        ]);

    }   

    
    public function userJoin_contest(Request $request)
    {
        $user_id=$request->input('user_id');
        $contest_id=$request->input('contest_id');
        $team_id=$request->input('team_id');
        $team_name=$request->input('team_name');
        $game_type=$request->input('game_type');
        $match_id=$request->input('match_id');
        $CricMatch=new CricMatch();
        $contest_detail=$CricMatch->contest_detail_model($contest_id);
        foreach ($contest_detail as $value) {
            // $match_id=$value->match_id;
            // $game_type=$value->game_type;
            
        }
        $football_contest=DB::table('football_contests')->where(array("id"=>$contest_id))->get();
        foreach ($football_contest as $val) {
            
        }
        if($game_type=="cricket")
        {
            $entry_fee=$value->entry_fee;
        }
        if($game_type=="football")
        {
            $entry_fee=$val->entry_fee; 
        }
        $data=array(
            'user_id'=>$user_id,
            'contest_id'=>$contest_id,
            'team_id'=>$team_id,
            'team_name'=>$team_name,
            'match_id'=>$match_id,
            'game_type'=>$game_type,
            'entry_fee'=>$entry_fee
        );
        
        if(DB::table('user_contests')->where(array("user_id"=>$user_id,"contest_id"=>$contest_id))->exists())
        {
            
            return response()->json(["status" => 3,"message" => "User Already Exist"]);
        }else
        {
            $result_usercontest=$CricMatch->usercontestModel($data);
            
            if($result_usercontest>0)
            {
                if($game_type=="cricket")
                {
                    $max_remaining_entry=$value->max_remaining_entry;   
                    $new_max_remaining_entry=$max_remaining_entry-1;
                    DB::table('cricket_contests')->where(array("id"=>$contest_id))->update(array("max_remaining_entry"=>$new_max_remaining_entry));
                }
                if($game_type=="football")
                {
                    $max_remaining_entry=$val->max_remaining_entry;   
                    $new_max_remaining_entry=$max_remaining_entry-1;
                    DB::table('football_contests')->where(array("id"=>$contest_id))->update(array("max_remaining_entry"=>$new_max_remaining_entry));
                }
                
                return response()->json(["status" => 1,"message" => "Success"]);
            }else
            {
                return response()->json(["status" => 2,"message" => "Error"]);
            }
        }
    }
    // User Contest Teams

    public function Cricket_User_Teams(Request $request)
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
        $res_user_team=$CricMatch->Cricket_User_Teams_Model($user_id,$team_json,$match_id);
        // return $data;
        
        
        // return response()->json(["status" => 1,"message" => "Success"]);
        


    }
    public function Cricket_User_Teams_get(Request $request)
    {
        // $user_id=1;
        // $match_id=24915;
        $user_id=$request->post('user_id');
        $match_id=$request->post('match_id');
        $CricMatch=new CricMatch();
        // return $match_id;
        $res=$CricMatch->Cricket_User_Teams_Model_get($user_id,$match_id);
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
    // Live Scores
    public function CricLiveScores()
    {
        $api_token = "Vs99FDycm6GHwRj4Cr9x67QC8d1S2ShJVQ7crytfZ7DBhrI4FFM1irajfKv3";
        $livescore='https://cricket.sportmonks.com/api/v2.0/livescores?api_token='.$api_token;
        $livescore_res = Http::get($livescore);
        $livescore_data = $livescore_res["data"];
    // $curl = curl_init();
        // $res=json_encode($livescore_data);
        // return $res;
    // curl_setopt_array($curl, array(
    // CURLOPT_URL => 'https://cricket.sportmonks.com/api/v2.0/livescores?api_token='.$api_token,
    // CURLOPT_RETURNTRANSFER => true,
    // CURLOPT_ENCODING => '',
    // CURLOPT_MAXREDIRS => 10,
    // CURLOPT_TIMEOUT => 0,
    // CURLOPT_FOLLOWLOCATION => true,
    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    // CURLOPT_CUSTOMREQUEST => 'GET',
    // ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

        // /if($res)
        // {
            return response()->json(["status" => 1,"message" => "Success","data"=>$livescore_data]);
        // }else
        // {
            // return response()->json(["status" => 2,"message" => "Error From Api"]);
        // }
    }
    public function Testing_Score()
    {
      
        // Starts Here
        // echo "Updating Score";
        $api_key = "Vs99FDycm6GHwRj4Cr9x67QC8d1S2ShJVQ7crytfZ7DBhrI4FFM1irajfKv3";
        $api_url  = "https://cricket.sportmonks.com/api/v2.0";
        $api_fetch_fixtures = "$api_url/livescores/?api_token=$api_key&include=batting,bowling,scoreboards";
        // API Call to fetch data and convert to json
        $jsons = file_get_contents($api_fetch_fixtures);
        $fixtures = json_decode($jsons, true)["data"];
        // $todaysMatches = CricMatches::where('start_date','>=',Carbon::now());

        // Point Constants

        $points = [
            "starting_xi" => 4,
            "run_scored" => 1,
            "wicket" => 25,
            "catch_out" => 8,
            "run_out" => 7,
            "dismissal_for_duck" => 0
        ];
        // bonus points
        $bonus_points = [
            "four" => 0,
            "six" => 0,
            "30+" => 0,
            "50+" => 0,
            "C" => 0,
            "MAIDEN" => 0,
            "2w" => 0,
            "3w" => 0,
            "4w" => 0,
            "5w+" => 0,
            // Economy rates - Bowlers
            "<2.5" => 0,
            "2.5-3.49" => 0,
            "3.5-3.99" => 0,
            "4-4.9" => 0,
            "5-6" => 0,
            "6-7" => 0,
            "7-8" => 0,
            "8-9" => 0,
            "9-10" => 0,
            "10-11" => 0,
            "11-12" => 0,
            "12-13" => 0,
            "13+" => 0,
            // Strike Rates - Batsmen
            "<40" => 0,
            "40-50" => 0,
            "50-60" => 0,
            "<50" => 0,
            "50-60" => 0,
            "60-70" => 0,
            "<80" => 0,
            "80-89.99" => 0,
            "90-99.99" => 0
        ];
        // Bowler Point Details 
        $point_details_bowler = [
            "wickets" => 0,
            "rate" => 0,
            "overs" => 0,
        ];
        $point_details_batsman = [
            "runs" => 0,
            "fours" => 0,
            "sixes" => 0,
            "balls" => 0,
            "rate" => 0
        ];

        // Fetch todays Live matches
        // If Live Update the Points according to the given Scheme
        // Call Fixture of that particular match and check live status
        // If status not Live, Set Winner Team, Update the Points according to the Bonus Scheme, and Stop Scheduler

        // Live Match Point Evaluation
        // echo json_encode($fixtures);
        // return;
        // foreach for fixture starts here 
        foreach ($fixtures as $lm) 
        {
            $rid = $lm["id"];
            // $userTeams[] = CricUserTeams::where("match_id", $lm["id"])->get();

            // ----------------------------------------------------------
            // DECIDES WHETHER MATCH ALREADY EXISTS IN LIVE MATCHES OR NOT  
            // ----------------------------------------------------------
            // IF CricMatchStatus starts 
            // if (!CricMatchStatus::where('match_id', $lm['id'])->exists()) 

            // {
                $newMatch = new CricMatchStatus;
                $newMatch->match_id = $lm["id"];
                $newMatch->status = 1;
                $newMatch->bonus_evaluation_done = 0;
                $newMatch->save();
                // Initializing the points detail array for all the players.
                $points_detail = array();
                $temp["event_name"] = "Starting XI";
                $temp["count"] = "No";
                $temp["points"] = 0;
                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    // $points_detail["i2"][] = $temp;
                }
                $temp["event_name"] = "Runs";
                $temp["count"] = "-";
                $temp["points"] = 0;
                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }
                $temp["event_name"] = "Balls";
                $temp["count"] = "-";
                $temp["points"] = 0;
                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }
                $temp["event_name"] = "Strike Rate";
                $temp["count"] = "-";
                $temp["points"] = 0;
                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }
                $temp["event_name"] = "4s";
                $temp["count"] = "-";
                $temp["points"] = 0;
                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }
                $temp["event_name"] = "6s";
                $temp["count"] = "-";
                $temp["points"] = 0;
                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }
                $temp["event_name"] = "30+ Runs";
                $temp["count"] = "-";
                $temp["points"] = 0;
                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }
                $temp["event_name"] = "50+ Runs";
                $temp["count"] = "-";
                $temp["points"] = 0;
                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }

                $temp["event_name"] = "Century";
                $temp["count"] = "-";
                $temp["points"] = 0;

                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }

                $temp["event_name"] = "Duck";
                $temp["count"] = "-";
                $temp["points"] = 0;

                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }

                $temp["event_name"] = "Wickets";
                $temp["count"] = "-";
                $temp["points"] = 0;

                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }
                $temp["event_name"] = "Overs";
                $temp["count"] = "-";
                $temp["points"] = "-";

                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }

                $temp["event_name"] = "Economy Rate";
                $temp["count"] = "-";
                $temp["points"] = 0;

                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }


                $temp["event_name"] = "Maiden";
                $temp["count"] = "-";
                $temp["points"] = 0;

                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }

                $temp["event_name"] = "Catches/Stumping";
                $temp["count"] = "-";
                $temp["points"] = 0;

                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }



                $temp["event_name"] = "Wicket Bonus";
                $temp["count"] = "-";
                $temp["points"] = 0;

                if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
                    $points_detail[] = $temp;
                } else {
                    // INNINGS
                    // $temp1["i1"] = $temp;
                    // $temp2["i2"] = $temp;
                    $points_detail["i1"][] = $temp;
                    $points_detail["i2"][] = $temp;
                }
                $mid = CricketMatches::where("fixture_id", $lm["id"])->first()->id;
                
                $players = CricPlayerPrice::where("match_id", $mid)->where("price", ">", 0)->pluck("player_id")->toArray();
                // return $players;
                foreach ($players as $plid) {
                    $player_id = $plid;
                    if (!(CricPlayerPoints::where(["match_id" => $lm['id'], "player_id" => $player_id])->exists())) {
                        $ncp = new CricPlayerPoints;
                        $ncp->match_id = $lm["id"];
                        $ncp->player_id =  $player_id;
                        $ncp->points_detail = json_encode($points_detail);
                        $ncp->points = 0;
                        $ncp->is_announced = 0;
                        $ncp->save();
                    }
                }
            // }
            // IF CricMatchStatus ends
            // }

            // --------------------------------------------------------------------------------
            // If there are players not announced, it would make an api call otherwise it won't.
            // --------------------------------------------------------------------------------
            // $not_announced = CricPlayerPoints::where(["match_id" => $lm["id"], "is_announced" => 0])->get();
            // if (!empty($not_announced)) 
            // {
            //     $api_fetch_lineup = "$api_url/livescores/$rid/?api_token=$api_key&include=lineup";
            //     $jsons = file_get_contents($api_fetch_lineup);
            //     $lineup = json_decode($jsons, true)["data"]["lineup"];
            //     foreach ($lineup as $player) {
            //         $player_id = $player["id"];
            //         $points_detail = array();

            //         // Initializing the points detail array again.

            //         $temp["event_name"] = "Starting XI";
            //         $temp["count"] = "Yes";
            //         $temp["points"] = 4;
            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             // $points_detail["i2"][] = $temp;
            //         }
            //         $temp["event_name"] = "Runs";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;
            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }
            //         $temp["event_name"] = "Balls";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;
            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }
            //         $temp["event_name"] = "Strike Rate";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;
            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }
            //         $temp["event_name"] = "4s";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;
            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }
            //         $temp["event_name"] = "6s";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;
            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }
            //         $temp["event_name"] = "30+ Runs";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;
            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }
            //         $temp["event_name"] = "50+ Runs";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;
            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }

            //         $temp["event_name"] = "Century";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;

            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }

            //         $temp["event_name"] = "Duck";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;

            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }

            //         $temp["event_name"] = "Wickets";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;

            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }


            //         $temp["event_name"] = "Overs";
            //         $temp["count"] = "-";
            //         $temp["points"] = "-";

            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }


            //         $temp["event_name"] = "Economy Rate";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;

            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }

            //         $temp["event_name"] = "Maiden";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;

            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }

            //         $temp["event_name"] = "Catches/Stumping";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;

            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }


            //         $temp["event_name"] = "Wicket Bonus";
            //         $temp["count"] = "-";
            //         $temp["points"] = 0;

            //         if ($lm["type"] != "Test/5day" && $lm["type"] != "4day") {
            //             $points_detail[] = $temp;
            //         } else {
            //             // INNINGS
            //             // $temp1["i1"] = $temp;
            //             // $temp2["i2"] = $temp;
            //             $points_detail["i1"][] = $temp;
            //             $points_detail["i2"][] = $temp;
            //         }

            //         // Update status from is_Announced 0 to is_announced 1...
            //         if (CricPlayerPoints::where(["match_id" => $lm["id"], "player_id" => $player_id])->exists()) {
            //             $player_rec = CricPlayerPoints::where(["match_id" => $lm["id"], "player_id" => $player_id])->first();
            //             $player_rec->points_detail = json_encode($points_detail);
            //             $player_rec->points = 4;
            //             $player_rec->is_announced = 1;
            //             $player_rec->save();
            //         }
            //     }
            // }

            // Announced Points and return
            // return;
            // echo json_encode($fixture);
            $bowlings = $lm['bowling'];
            $batting = $lm['batting'];
            $player_scores = array();
            $type = $lm['type'];


            $points = [
                "starting_xi" => 4,
                "run_scored" => 1,
                "wicket" => 0,
                "catch_out" => 8,
                "run_out" => 7,
                "dismissal_for_duck" => 0
            ];

            // Type Selection Begins
            $is_innings = 0;
            switch ($type) {
                case "Test/5day":
                    $points['wicket'] = 16;
                    $points['dismissal_for_duck'] = -5;
                    $is_innings = 1;
                    break;
                case "T20":
                    $points['wicket'] = 25;
                    $points['dismissal_for_duck'] = -2;
                    break;
                case "T10":
                    $points['wicket'] = 25;
                    $points['dismissal_for_duck'] = -2;
                    break;
                case "ODI":
                    $points['wicket'] = 25;
                    $points['dismissal_for_duck'] = -3;
                    break;
                case "4day":
                    $is_innings = 1;
                    break;
                default:
                    $is_innings = 0;
            }

            // ======================================================================
            // Check Innings
            $I1 = 0;
            $I2 = 0;
            if ($is_innings) {
                // Check which innings in the case of Test Match
                $num_scoreboards = count($lm["scoreboards"]);
                if ($num_scoreboards <= 4) {
                    $I1 = 1;
                    $I2 = 0;
                } else if ($num_scoreboards > 4) {
                    $I2 = 1;
                    $I1 = 0;
                } else {
                    $I1 = 0;
                    $I2 = 0;
                }

                // continue;
            }


            // =====================================================================

            // Map of positions
            $positions = array();
            $positions["batsman"] = array();
            $positions["bowlers"] = array();
            $catch_stump = array();
            // Clubbing the players
            foreach ($bowlings as $bowling) {
                $player_scores[] = $bowling;
                $positions["bowlers"][] = $bowling["player_id"];
            }
            foreach ($batting as $batsman) {
                if ($batsman["catch_stump_player_id"] != null) {
                    $catch_stump[] = $batsman["catch_stump_player_id"];
                }
                $player_scores[] = $batsman;
                $positions["batsman"][] = $batsman["player_id"];
            }
            foreach ($player_scores as $p_r) 
            {
                // Continue

                $player_points  =  CricPlayerPoints::where(["match_id" => $lm["id"], "player_id" => $p_r['player_id'], "is_announced" => 1]);
                if ($player_points->exists()) {
                    $point_details = json_decode($player_points->first()->points_detail, true);
                    $update_details = array();
                    $total_points = 0;
                    if ($I1 == 1) {
                        $update_details["i2"] = $point_details["i2"];
                        $update_details["i1"] = array();
                        foreach ($point_details["i2"] as $arb) {
                            $total_points += intval($arb["points"]);
                        }
                        $point_details = $point_details["i1"];
                    }
                    if ($I2 == 1) {
                        $update_details["i1"] = $point_details["i1"];
                        $update_details["i2"] = array();
                        foreach ($point_details["i1"] as $arb1) {
                            $total_points += intval($arb1["points"]);
                        }
                        $point_details = $point_details["i2"];
                        // echo json_encode(["I2"=>$point_details]);
                        // return;
                    }


                    // echo json_encode($p_r["sdfs"]);
                    // return;
                    foreach ($point_details as $pd) {

                        switch ($pd['event_name']) {
                                // case "Starting XI":
                            case "Runs":
                                if (in_array($p_r["player_id"], $positions["batsman"]) && $p_r["resource"] == "battings") {
                                    $pd["count"] = array_key_exists("score", $p_r) ? ($p_r["score"]) : 0;
                                    $pd["points"] = array_key_exists("score", $p_r) ? ($p_r["score"]) : 0;
                                } else if ($pd["count"] != 0) {
                                    $pd = $pd;
                                } else {
                                    $pd["count"] = 0;
                                    $pd["points"] = 0;
                                }
                                break;

                            case "Strike Rate":
                                if (in_array($p_r["player_id"], $positions["batsman"]) && $p_r["resource"] == "battings") {
                                    $pd["count"] = $p_r["rate"];
                                    $pd["points"] = 0;
                                } else if ($pd["count"] != 0) {
                                    $pd = $pd;
                                } else {
                                    $pd["count"] = "-";
                                    $pd["points"] = "-";
                                }
                                break;

                            case "4s":
                                $pd["count"] = array_key_exists("four_x", $p_r) ? ($p_r["four_x"]) : 0;
                                $pd["points"] = array_key_exists("four_x", $p_r) ? ($p_r["four_x"]) : 0;
                                break;
                            case "6s":
                                $pd["count"] = array_key_exists("six_x", $p_r) ? ($p_r["six_x"]) : 0;
                                $pd["points"] = array_key_exists("six_x", $p_r) ? ($p_r["six_x"]) * 2 : 0;
                                break;

                            case "Wickets":
                                if (array_key_exists("wickets", $p_r)) {
                                    $pd["count"] = array_key_exists("wickets", $p_r) ? ($p_r["wickets"]) : 0;
                                    $pd["points"] = array_key_exists("wickets", $p_r) ? ($p_r["wickets"]) * $points["wicket"] : 0;
                                }
                                break;
                            case "Economy Rate":
                                if (in_array($p_r["player_id"], $positions["bowlers"]) && $p_r["resource"] == "bowlings") {
                                    // echo json_encode(["Changing Economy Rate"=>$pd]);
                                    // echo "Changin ER for: ".$p_r["player_id"];
                                    $pd["count"] = $p_r["rate"];
                                    $pd["points"] = 0;
                                    // echo json_encode(["Changed Economy Rate"=>$pd]);
                                } else if ($pd["count"] != 0) {
                                    $pd = $pd;
                                } else {
                                    $pd["count"] = "-";
                                    $pd["points"] = "-";
                                }
                                break;
                            case "Catches/Stumping":
                                if (in_array($p_r["player_id"], $positions["bowlers"])) {
                                    if (in_array($p_r["player_id"], $catch_stump)) {
                                        $count = array_count_values($catch_stump)[$p_r["player_id"]];
                                        $pd["count"] = $count;
                                        // 8--points for a catch
                                        $pd["points"] = $count * 8;
                                    }
                                }
                                break;
                            case "Overs":
                                if (in_array($p_r["player_id"], $positions["bowlers"])) {
                                    $pd["count"] = array_key_exists("overs", $p_r) ? ($p_r["overs"]) : 0;
                                } else {
                                    $pd["count"] = "-";
                                }
                                break;
                            case "Maiden":
                                if (in_array($p_r["player_id"], $positions["bowlers"])) {
                                    $pd["count"] = array_key_exists("medians", $p_r) ? ($p_r["medians"]) : 0;
                                } else {
                                    $pd["count"] = "-";
                                }
                                break;

                            case "Balls":
                                if (array_key_exists("ball", $p_r)) {
                                    $pd["count"] = array_key_exists("ball", $p_r) ? ($p_r["ball"]) : 0;
                                    $pd["points"] = "-";
                                }
                                break;
                            default:
                                // echo "Score Update";
                        }

                        if ($I1 == 1) {
                            $update_details["i1"][] = $pd;
                        } else if ($I2 == 1) {
                            $update_details["i2"][] = $pd;
                        } else {
                            $update_details[] = $pd;
                        }
                        if ($pd["points"] != "-") {
                            $total_points += $pd["points"];
                        }
                    }

                    $player_points->update([
                        "points_detail" => json_encode($update_details),
                        "points" => $total_points
                    ]);
                }
            }
        }
        // Foreach of fixture ends here






        /*-------------------------------------------------------------------------*/
        /*   USER RANKS CALCULATION AND WALLET AMOUNT UPDATE */
        $teamPoints = array();
        $matches_to_rank = CricMatchStatus::where("status", 1)->orWhere(["status" => 0, "bonus_evaluation_done" => 1])->pluck("match_id")->toArray();
        // $matches_to_rank = CricMatches::all();
        $userTeams = array();
        // Changes
        // $CricMatch=new CricMatch();
        foreach ($matches_to_rank as $mId) {
            // $uTs =    CricUserTeams::where("match_id", $mId)->get(); //do changes here in cricUser Teams
            $uTs=DB::table('cric_user_team')->where(array("match_id"=>$mId))->get();
            foreach ($uTs as $uT) {
                if ($uT) {
                    $userTeams[] = $uT;
                }
            }
        }
        // Changes ends
        $uids = array();

        foreach ($userTeams as $ut) {
            // Chnages Here
            // $teamPlayers = CricUserTeamPlayers::where("team_id", $ut->id)->get();
            $teamPlayers=DB::table('cric_user_team')->where(array("team_id"=>$ut->id))->get();
            $team_user_id = $ut->user_id;
            $userTeamPoints = 0;
            $matchId = $ut->match_id;
            // Changes
            foreach ($teamPlayers as $tp) {
                if (CricPlayerPoints::where(['player_id' => $tp->player_id, 'match_id' => $ut->match_id])->exists()) {
                    $player_points = CricPlayerPoints::where(['player_id' => $tp->player_id, 'match_id' => $ut->match_id])->first()->points;
                    if($tp->is_c){
                        $player_points=2*$player_points;
                    }
                    if($tp->is_vc){
                        $player_points=1.5*$player_points;
                    }
                    $userTeamPoints += $player_points;
                }
            }

            $userContest = CricUserContest::where(["user_id" => $team_user_id, "team_id" => $ut->id])->first();
            // echo "USER CONTEST: ";
            if ($ut->id == 77) {
                echo json_encode($userContest);
            }
            // echo json_encode($userTeams);

            if (!CricUserContestRank::where("team_id", $ut->id)->exists()) {
                // echo json_encode($userContest);
                if ($userContest != null) {
                    $newContestRank = new CricUserContestRank;
                    $newContestRank->user_id = $team_user_id;
                    $newContestRank->team_id = $ut->id;
                    $newContestRank->partic3ipant_name = User::find($ut->user_id)->full_name;
                    $newContestRank->points = $userTeamPoints;
                    $newContestRank->contest_id = $userContest["contest_id"];
                    $newContestRank->series_id = $matchId;
                    $newContestRank->save();
                }
            } else {
                $userContests = CricUserContest::where(["user_id" => $team_user_id, "team_id" => $ut->id])->get();
                foreach ($userContests as $userContest) {
                    CricUserContestRank::where([
                        "user_id" => $team_user_id,
                        "contest_id" => $userContest["contest_id"],
                        "team_id" => $ut->id
                    ])->update(["points" => $userTeamPoints]);
                }
            }
        }

        // Rank Allocation
        $all_contest_ids = CricContests::where("game_status", 1)->pluck("id")->toArray();
        foreach ($all_contest_ids as $c_id) {
            if (CricUserContestRank::where("contest_id", $c_id)->exists()) {
                $userRanks = CricUserContestRank::where("contest_id", $c_id)->orderBy("points", "DESC")->get();
                $prev_points = 0;
                $temp_rank = 1;
                $rank = 0;
                foreach ($userRanks as $ucr) {
                    if ($ucr->points != $prev_points) {
                        $rank = $temp_rank;
                    }
                    $temp_rank++;
                    CricUserContestRank::where([
                        "user_id" => $ucr->user_id,
                        "contest_id" => $ucr->contest_id,
                        "team_id" => $ucr->team_id
                    ])->update(["rank" => $rank]);

                    $prev_points = $ucr->points;
                }

                // Won Amount Allocation
                $contest = CricContests::find($c_id);

                // Won Amount only when contest is not free
                if (($contest->is_free == 0)) {
                    $breakdown = json_decode($contest->prize_breakdown, true)['breakdowns'];
                    $breakdownMap = array();
                    // fill the breakdown map
                    foreach ($breakdown as $bd) {
                        $l = intval($bd['from']);
                        $h = intval($bd['to']);
                        while ($l <= $h) {
                            $breakdownMap[$l] = $bd["amt_per_person"];
                            $l++;
                        }
                    }
                    // echo json_encode($breakdownMap);
                    // Allot amount
                    // return;

                    foreach ($breakdownMap as $rank => $amount) {
                        if (CricUserContestRank::where(["contest_id" => $contest["id"], "rank" => $rank, "won_amount" => 0])->exists()) {
                            $rankCount = CricUserContestRank::where("contest_id", $contest->id)->where("rank", $rank)->count();


                            // echo "Rank: " . $rank . " " . "Count:" . $rankCount . "\n";
                            $temp = intval($rank);
                            $limit = $temp + $rankCount;

                            $totalWonAmount = 0;

                            while ($temp < $limit) {
                                // echo "temp: ".$temp;
                                $totalWonAmount = $totalWonAmount + ($breakdownMap[$temp]);
                                $temp++;
                            }
                            $totalWonAmount = floatval($totalWonAmount / $rankCount);
                        }
                    }
                }
            }
        }

        // Wallet
        $userRanks = CricUserContestRank::all();
        // Update User Wallet Transaction
        // echo json_encode($userRanks);
        // return;
        foreach ($userRanks as $ucr) {
            $cont = CricContests::where("id", $ucr->contest_id)->first();
            $match_id = $cont->series_id;
            $ended = CricMatchStatus::where("match_id", $match_id)->first();
            // echo json_encode(["matchid"=>$match_id, "ended"=>$ended]);
            // return;
            if ($ended != null) {
                if ($ended['status'] == 1 && $ended['bonus_evaluation_done'] == 0) {
                    continue;
                }
            }
            if ($ucr->won_amount > 0) {
                $tmp_uw = UserWalets::firstOrNew(['user_id' => $ucr->user_id, 'contest_id' => $ucr->contest_id, 'team_id' => $ucr->team_id]);
                $tmp_uw->user_id = $ucr->user_id;
                $tmp_uw->contest_id = $ucr->contest_id;
                $tmp_uw->team_id =  $ucr->team_id;
                $tmp_uw->transaction_type = 3;
                $tmp_uw->amount = $ucr->won_amount;
                $tmp_uw->save();

                $win_uw = UserWalets::where('user_id', $ucr->user_id)->where('transaction_type', 3)->sum('amount'); // won amount 
                $wd_uw = UserWalets::where('user_id', $ucr->user_id)->where('transaction_type', 4)->where('status', 2)->sum('amount');

                User::where('id', $ucr->user_id)->update(["won_amount" => ($win_uw - $wd_uw)]); // final won amount is total won - withdrawn amount into bank
            }
        }

        // Scoreboards
        $pastMatches = CricMatchStatus::where(["status" => 1, "bonus_evaluation_done" => 0])->pluck("match_id")->toArray();

        foreach ($pastMatches as $pm) {
            $p_m = CricketMatches::where("fixture_id", $pm)->exists();
            if ($p_m) {
                $is_innings = 0;
                $p_m = CricketMatches::where("fixture_id", $pm)->first();
                if ($p_m->type == "Test/5day" || $p_m->type == "4day") {
                    $is_innings = 1;
                }

                $api_key = "Vs99FDycm6GHwRj4Cr9x67QC8d1S2ShJVQ7crytfZ7DBhrI4FFM1irajfKv3";
                $api_url  = "https://cricket.sportmonks.com/api/v2.0";
                $api_fetch_fixture = "$api_url/fixtures/$p_m->fixture_id/?api_token=$api_key&include=scoreboards";
                $data = json_decode(file_get_contents($api_fetch_fixture), true)["data"];
                $scores = $data["scoreboards"];
                if ($is_innings) {
                    $temp = array();
                    $temp["T1"] = 0;
                    $temp["T2"] = 0;
                    $temp["W"] = "";
                    $temp_i["i1"] = $temp;
                    $temp_i["i2"] = $temp;
                } else {
                    $temp = array();
                    $temp["T1"] = 0;
                    $temp["T2"] = 0;
                    $temp["W"] = "";
                }

                $t1 = 0;
                $t2 = 0;
                if (!$is_innings) {
                    foreach ($scores as $score) {
                        if ($score["type"] == "total") {
                            if ($score["team_id"] == $p_m->team1_id) {
                                $temp["T1"] = strval($score["total"]) . "/" . $score["wickets"];
                                $t1 = $score["total"];
                            } else {
                                $temp["T2"] = strval($score["total"]) . "/" . $score["wickets"];
                                $t2 = $score["total"];
                            }
                        }
                    }
                    if ($t1 > $t2) {
                        $temp["W"] = $p_m->team1;
                    } else if ($t2 > $t1) {
                        $temp["W"] = $p_m->team2;
                    } else if ($t1 == $t2) {
                        $temp["W"] = "Tied";
                    } else {
                        $temp["W"] = "";
                    }
                } else {
                    foreach ($scores as $score) {
                        // 1st innings
                        if ($score["type"] == "total" && ($score["scoreboard"] == "S1" || $score["scoreboard"] == "S2")) {
                            if ($score["team_id"] == $p_m->team1_id) {
                                $temp_i["i1"]["T1"] = strval($score["total"]) . "/" . $score["wickets"];
                            } else {
                                $temp_i["i1"]["T2"] = strval($score["total"]) . "/" . $score["wickets"];
                            }
                            $t1 = $temp_i["i1"]["T1"];
                            $t2 = $temp_i["i1"]["T2"];
                            if ($t1 > $t2) {
                                $temp_i["i1"]["W"] = $p_m->team1;
                            } else if ($t2 > $t1) {
                                $temp_i["i1"]["W"] = $p_m->team2;
                            } else if ($t1 == $t2) {
                                $temp_i["i1"]["W"] = "Tied";
                            } else {
                                $temp_i["i1"]["W"] = "";
                            }
                        } else if ($score["type"] == "total" && ($score["scoreboard"] == "S3" || $score["scoreboard"] == "S4")) {
                            if ($score["team_id"] == $p_m->team1_id) {
                                $temp_i["i2"]["T1"] = strval($score["total"]) . "/" . $score["wickets"];
                            } else {
                                $temp_i["i2"]["T2"] = strval($score["total"]) . "/" . $score["wickets"];
                            }
                            $t1 = $temp_i["i2"]["T1"];
                            $t2 = $temp_i["i2"]["T2"];
                            if ($t1 > $t2) {
                                $temp_i["i2"]["W"] = $p_m->team1;
                            } else if ($t2 > $t1) {
                                $temp_i["i2"]["W"] = $p_m->team2;
                            } else if ($t1 == $t2) {
                                $temp_i["i2"]["W"] = "Tied";
                            } else {
                                $temp_i["i2"]["W"] = "";
                            }
                            if ($temp_i["i2"]["T1"] == 0) {
                                $temp_i["i2"]["T1"] = "0/0";
                            } else if ($temp_i["i2"]["T2"] == 0) {
                                $temp_i["i2"]["T2"] = "0/0";
                            } else {
                            }
                        } else {
                            echo "";
                        }
                    }
                    $temp = $temp_i;
                }



                $p_m->winner = json_encode($temp);
                $p_m->save();
            }
        }


        // Cron Entry
        $cron_rec = new CronRecord;
        $cron_rec->status = "Updated Scores";
        $cron_rec->date_time = Carbon::now();
        $cron_rec->error_log = null;
        $cron_rec->save();

        // Ends Here  
        
        
    }
    // User Joined Contest Details
    public function userJoin_get_contest(Request $request)
    {
        $data=array(
        'user_id'=>$request->post('user_id'),
        'match_id'=>$request->post('match_id'),
        'game_type'=>$request->post('game_type'),
        );
        $CricMatch=new CricMatch();

        $res=$CricMatch->getUserJoined($data);
        $game_type=$data['game_type'];
        foreach ($res as  $value) {
            if($game_type=="cricket"){
            //  $res3=DB::table('cricket_fixtures')->where(array("fixture_id"=>$data['match_id']))->get();   
            $res2=DB::table('cricket_contests')->where(array("id"=>$value->contest_id))->get();
            foreach ($res2 as  $val) {
                $breakdown=stripslashes($val->breakdown);
                $prize_breakdown=json_decode($breakdown);
            }
        }
        if($game_type=="football")
        {
            // $res3=DB::table('unique_matchs')->where(array("match_key"=>$data['match_id'],"API"=>"roanuz"))->get();
            $res2=DB::table('football_contests')->where(array("id"=>$value->contest_id))->get();
            foreach ($res2 as  $val) {
                $breakdown=stripslashes($val->breakdown);
                $prize_breakdown=json_decode($breakdown);
            } 
        }
            $detail=array(
                'user_id'=>$value->user_id,
                'match_id'=>$data['match_id'],
                'contest'=>$res2,
                'game_type'=>$value->game_type,
                'entry_fee'=>$value->entry_fee,
                'players'=>$value->players,
                'team_id'=>$value->team_id,
                

            );
            // echo $detail;
            // echo "working";
            $result_data[]=$detail;
        }
        
        return response()->json(["status" => 1,"message" => "Success","data"=>$result_data]);   
    }
    public function CricLeaderBoard(Request $request)
    {
        $contest_id=$request->post('contest_id');
        $res=DB::table('cric_user_contest_rank')->where(array("contest_id"=>$contest_id))->get();
        if($res)
        {
            return response()->json(["status" => 1,"message" => "Success","data"=>$res]);
        }else
        {
            return response()->json(["status" => 2,"message" => "No Data or Error"]);
        }
    }
    public function UserMatchData(Request $request)
    {
        $user_id=$request->post('user_id');
        $result_cric = array(); 
        $result = array();
        $ret=DB::table('user_contests')->where(array("user_id"=>$user_id))->get();
        foreach ($ret as $value) 
        {
              
            // Cricket Starts Here
            if ($value->game_type=="cricket") 
            {
                    $data_cric=DB::table('cricket_fixtures')->where(array("fixture_id"=>$value->match_id))->get();

        
                            

                            foreach ($data_cric as $val_cric) 
                            {

                                $visitorteam_cric= cricket_fixture_teams::where('team_id', $val_cric->visitorteam_id)->first();
                                $localteam_cric= cricket_fixture_teams::where('team_id', $val_cric->localteam_id)->first();
                                
                                $arr_cric = array(
                                    "id" => $val_cric->id,
                                    "fixture_id" => $val_cric->fixture_id,               
                                    "title" => $visitorteam_cric->name . " Vs " . $localteam_cric->name,
                                    "short_title" => $visitorteam_cric->code . " Vs " . $localteam_cric->code,
                                    "type" => $val_cric->type,
                                    "start_date" => $val_cric->starting_at,
                                    'match_status'=>$val_cric->status,

                                    "teams" => array(
                                        array(
                                            "team_id" => $visitorteam_cric->id,
                                            "name" => $visitorteam_cric->name,
                                            "short_name" => $visitorteam_cric->code,
                                            "flag" => $visitorteam_cric->image_path),
                                        array(
                                        "team_id" => $localteam_cric->id,
                                            "name" => $localteam_cric->name,
                                            "short_name" => $localteam_cric->code,
                                            "flag" => $localteam_cric->image_path)),

                                );

                                
                            
                                        $result_cric[] = $arr_cric;
                            }
            //                 // echo json_encode($result_cric);



            }

            // Cricket Ends here
            // Football Starts here
            
            if($value->game_type=="football")
            {
        //     // $data = unique_matchs::all();
            $data=DB::table('unique_matchs')->where(array("match_key"=>$value->match_id))->get();
            
                // echo json_encode($data);
        //     // echo json_encode($data);
        //     // echo json_encode($value->match_id);
            foreach ($data as $val) 
            {
                
                    $roanuz_match_teams=new roanuz_match_teams();
                    $visitorteam=$roanuz_match_teams->getVisitor($val->match_away_team);
                    $localteam = $roanuz_match_teams->getLocal($val->match_home_team);
                    foreach ($localteam as $teamone) {
                    }
                    
                    foreach ($visitorteam as $teamtwo) {
            
                    }
                    $teams = array(
                            array(
                            "id" => $teamtwo->id,
                            "team_id" => $teamtwo->team_key,
                             "name" => $teamtwo->team_name,
                            "short_name" => $teamtwo->team_short_name,
                            "flag" => null),
                            array(
                            "id" => $teamtwo->id,
                            "team_id" => $teamtwo->team_key,
                             "name" => $teamtwo->team_name,
                            "short_name" => $teamtwo->team_short_name,
                            "flag" => null)
                        );
                         
    
                $arr = array(
                    "id" => $val->id,
                    "match_key" => $val->match_key,
                    "title" => $val->match_name,
                     "short_title" => $val->match_short_name,
                    "start_date" => $val->match_start_date . " " . $val->match_start_time,
                    "type" => $val->tournament_name,
                    "teams" => $teams,
                    "match_status"=>$val->match_status,
                    "API" => $val->API);

                    
                    $result[] = $arr;
                
                
                
            }
               
             
        //     // Football Ends Here
        } //else{$result = array();}

    }
        $match_data=array(
                'cricket_match'=>$result_cric,
                'football_match'=>$result
                
                
        );

        return response()->json(["status" => 1,"message" => "Success","data"=>$match_data]);
        
    }
    public function UserLeaderBoard(Request $request)
    {
        $contest_id=$request->post('contest_id');
        $game_type=$request->post('game_type');

        $res=DB::table('user_contests')->where(array("contest_id"=>$contest_id,"game_type"=>$game_type))->get();
        return response()->json(["status" => 1,"message" => "Success","data"=>$res]);
    }
    public function all_team_data(Request $request)
    {
        $team_id=$request->post('team_id');
        $game_type=$request->post('game_type');
        if($game_type=="cricket")
        {
            $ret=DB::table('cric_user_team')->where(array("id"=>$team_id))->get();
            
        }
        if($game_type=="football")
        {
            $ret=DB::table('football_user_team')->where(array("id"=>$team_id))->get();
            
        }
        foreach ($ret as $value) {
            
        }
        $data=array(
            'id'=>$value->id,
            'user_id'=>$value->user_id,
            'team'=>json_decode(stripslashes($value->teams)),
            'match_id'=>$value->match_id
        );

        
        return response()->json(["status" => 1,"message" => "Success","data"=>$data]);
        
    }
    




}
