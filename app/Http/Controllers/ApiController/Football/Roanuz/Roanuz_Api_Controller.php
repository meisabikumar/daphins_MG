<?php

namespace App\Http\Controllers\ApiController\Football\Roanuz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\ApiModel\football\roanuz\roanuz_recent_tournament;
use App\Models\ApiModel\football\roanuz\roanuz_tournament_rounds;
use App\Models\ApiModel\football\roanuz\roanuz_matchs;
use App\Models\ApiModel\football\roanuz\roanuz_match_teams;
use App\Models\ApiModel\football\FootBallModel;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;

class Roanuz_Api_Controller extends Controller
{

    // Function to generate Api_access_token
    public function roanuz_Auth(){
        $response = Http::post('https://api.footballapi.com/v1/auth/', [
            'access_key' => '72f44464a24650ee6c0da5ee93ce5ecd',
            'secret_key' => 'ae8dee4499e678bef75682d709279550',
            'app_id' => 'com.saisupp',
            'device_id' => 'developer',
        ]);

        if($response->successful()){
           return $api_access_token = $response["auth"]["access_token"];
        }else{
            return response()->json(['error' =>"error"],400);
        }
    }

    // Function to get recent tournaments -- api name : (Recent Tournament API)
    public function roanuz_recent_tournament(){


        //calling roanuzAuth() to get api_access token
        $api_token=$this->roanuz_Auth();

        //Api Url
        $url="https://api.footballapi.com/v1/recent_tournaments/?access_token=".$api_token;

        //Response from Api
        $response = Http::get($url);

        //empty tournamnets table to avoid repeted data
        roanuz_recent_tournament::truncate();

        $start_date=date("Y-m-d");
        $date=date_create($start_date);
        date_add($date,date_interval_create_from_date_string("5 days"));
        $end_date=date_format($date,"Y-m-d");

        //Loop through recived data
        foreach ($response["data"]["tournaments"] as $value) {

            $tournament_start_date_time_GMT = new DateTime($value['start_date']['gmt'], new DateTimeZone('GMT'));
            $tournament_start_date_time_IST = $tournament_start_date_time_GMT->setTimezone(new DateTimeZone('IST'))->format('Y-m-d H:i:s');

            $tournament_end_date_time_GMT = new DateTime($value['end_date']['gmt'], new DateTimeZone('GMT'));
            $tournament_end_date_time_IST = $tournament_end_date_time_GMT->setTimezone(new DateTimeZone('IST'))->format('Y-m-d H:i:s');

            $tournament_end_date_IST = $tournament_end_date_time_GMT->setTimezone(new DateTimeZone('IST'))->format('Y-m-d');

            if($tournament_end_date_IST >= $start_date){

                $data=new roanuz_recent_tournament;
                $data->competition_key=$value['competition']['key'];
                $data->competition_name=$value['competition']['name'];
                $data->competition_short_name=$value['competition']['short_name'];

                $data->tournament_key=$value['key'];
                $data->tournament_name=$value['name'];
                $data->tournament_short_name=$value['short_name'];

                $data->start_date=$tournament_start_date_time_IST;
                $data->end_date=$tournament_end_date_time_IST;
                $data->save();

            }
            // save Data to Database

        }

        return response()->json(['success' =>"saved"],200);

    }

    //  -- api name : (Tournament API)
    public function roanuz_tournament_rounds(){
        // calling roanuzAuth() to get api_access token
        $api_token=$this->roanuz_Auth();

        // get all the Tournaments from Database
        $tournaments=roanuz_recent_tournament::all();

        // empty Teams table to avoid repeted data
        roanuz_tournament_rounds::truncate();

        // Loop through each tournaments present in database
        foreach ($tournaments as $value) {

            // Api Url
            $url="https://api.footballapi.com/v1/tournament/".$value["tournament_key"]."/?access_token=".$api_token;

            // response From Api
            $response = Http::get($url);

           foreach ($response["data"]["tournament"]["rounds"] as $value) {
            $data=new roanuz_tournament_rounds;
            $data->round_key=$value['key'];
            $data->round_name=$value['name'];
            $data->groups=$value['groups']; //json
            $data->round_teams=$value['teams']; //json

                    // --------------- //
            $data->tournament_key=$response["data"]["tournament"]['key'];
            $data->tournament_legal_name=$response["data"]["tournament"]['legal_name'];
            $data->tournament_name=$response["data"]["tournament"]['name'];
            $data->tournament_short_name=$response["data"]["tournament"]['short_name'];
            $data->pointing_system=$response["data"]["tournament"]['pointing_system'];

            $start_date = new DateTime($response["data"]["tournament"]['start_date']['gmt'], new DateTimeZone('GMT'));
            $data->tournament_start_date=$start_date->setTimezone(new DateTimeZone('IST'))->format('Y-m-d H:i:s');

            $end_date = new DateTime($response["data"]["tournament"]['end_date']['gmt'], new DateTimeZone('GMT'));
            $data->tournament_end_date=$end_date->setTimezone(new DateTimeZone('IST'))->format('Y-m-d H:i:s');

            $data->competition_data=$response["data"]["tournament"]['competition']; //json
                    // --------------- //

            $data->tournament_teams=$response["data"]["tournament"]['teams']; //json

            $data->save();

           }

        }
        return response()->json(['success' =>"saved"],200);

    }

    //  -- api name : (Tournament Round API)
    public function roanuz_matchs(){

        // calling roanuzAuth() to get api_access token
        $api_token=$this->roanuz_Auth();

        //
        $rounds=roanuz_tournament_rounds::select('round_key','tournament_key')->get();

        //empty Players table to avoid repeted data
        roanuz_matchs::truncate();

        $start_date=date("Y-m-d");
        $date=date_create($start_date);
        date_add($date,date_interval_create_from_date_string("15 days"));
        $end_date=date_format($date,"Y-m-d");

        // Loop through Teams present in Database
        foreach ($rounds as $round) {

            // Api Url
            $url="https://api.footballapi.com/v1/tournament/".$round["tournament_key"]."/round-detail/".$round["round_key"]."/?access_token=".$api_token;

            // Response from Api
            $response = Http::get($url);


            // loop through players in Team
            foreach ($response["data"]["round"]["matches"] as $value) {

            $match_start_date_GMT = new DateTime($value['match']['start_date']['gmt'], new DateTimeZone('GMT'));
            $match_start_date_IST = $match_start_date_GMT->setTimezone(new DateTimeZone('IST'))->format('Y-m-d');
            $match_start_time_IST = $match_start_date_GMT->setTimezone(new DateTimeZone('IST'))->format('H:i:s');


                if (strtotime($match_start_date_IST)  >= strtotime($start_date) && strtotime($match_start_date_IST)  <= strtotime($end_date )) {

                        $data=new roanuz_matchs;

                        $data->match_key=$value['match']['key'];
                        $data->match_away_team=$value['match']['away'];
                        $data->match_home_team=$value['match']['home'];
                        $data->match_name=$value['match']['name'];
                        $data->match_short_name=$value['match']['short_name'];
                        $data->match_start_date=$match_start_date_IST;
                        $data->match_start_time=$match_start_time_IST;
                        $data->match_status=$value['match']['status'];
                        $data->match_result=$value['result']['title'];

                        $data->round_key=$value['match']["round"]['key'];
                        $data->round_name=$value['match']["round"]['name'];

                        $data->groups=$response["data"]["round"]["groups"]; //json
                        $data->stadium=$value['match']["stadium"]; //json
                        $data->round_teams=$response["data"]["round"]["teams"]; //json

                        $data->tournament_key=$value['match']['tournament']['key'];
                        $data->tournament_name=$value['match']['tournament']['name'];
                        $data->tournament_short_name=$value['match']['tournament']['short_name'];
                        $data->tournament_legal_name=$value['match']['tournament']['legal_name'];

                        $data->save();

                }

            }

        }

        return response()->json(['success' =>"saved"],200);

    }

    // -- api name : (Tournament Team API)
    public function roanuz_match_teams(){

         // calling roanuzAuth() to get api_access token
         $api_token=$this->roanuz_Auth();

         // get all the match from Database
         $matchs=roanuz_matchs::all();

         // empty Teams table to avoid repeted data
         roanuz_match_teams::truncate();

         // Loop through each tournaments present in database
         foreach ($matchs as $value) {

             // Api Url
             $team_away="https://api.footballapi.com/v1/tournament/".$value["tournament_key"]."/team/".$value["match_away_team"]."?access_token=".$api_token;
             // response From Api
             $team_away_response = Http::get($team_away);

             $data = new roanuz_match_teams;
             $data->match_key = $value["match_key"];
             $data->team_key = $team_away_response["data"]["team"]["key"];
             $data->team_name = $team_away_response["data"]["team"]["name"];
             $data->team_short_name = $team_away_response["data"]["team"]["code"];
             $data->players = $team_away_response["data"]["team"]["players"]; //json

             $data->tournament_key = $value["tournament_key"];
             $data->tournament_name=$value["tournament_name"];
             $data->tournament_short_name=$value["tournament_short_name"];
             $data->tournament_legal_name=$value["tournament_legal_name"];
             $data-> save();

             // -----------------------

             $team_home="https://api.footballapi.com/v1/tournament/".$value["tournament_key"]."/team/".$value["match_home_team"]."?access_token=".$api_token;

             $team_home_response = Http::get($team_home);

             $data = new roanuz_match_teams;
             $data->match_key = $value["match_key"];
             $data->team_key = $team_home_response["data"]["team"]["key"];
             $data->team_name = $team_home_response["data"]["team"]["name"];
             $data->team_short_name = $team_home_response["data"]["team"]["code"];
             $data->players = $team_home_response["data"]["team"]["players"]; //json

             $data->tournament_key = $value["tournament_key"];
             $data->tournament_name=$value["tournament_name"];
             $data->tournament_short_name=$value["tournament_short_name"];
             $data->tournament_legal_name=$value["tournament_legal_name"];
             $data-> save();

         }

         return response()->json(['success' =>"saved"],200);


    }
    public function Player_points()
    {
        
        $api_token=$this->roanuz_Auth();
        $FootBallModel= new FootBallModel();
        $res_matches=$FootBallModel->match_data();
        foreach ($res_matches as $value) {
           $url="https://api.footballapi.com/v1/match/".$value->match_key."?access_token=".$api_token;
           $live_score = Http::get($url)->json();
           $live_score_player=$live_score['data']['players'];
        //    return $live_score_player
           $player_id=json_encode($live_score_player);
           $obj = json_decode($player_id, TRUE);

             foreach($obj as $key => $val) 
            {
                $ret=DB::table('football_match_player_point')->insert(array("match_id"=>$value->match_key,"player_id"=>$key));
                
            }
        
        }
        return response()->json(["status"=>1,"msg"=>"success"]);
         
            
    }
    public function player_update()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '3600');
        ini_set('max_input_time', '3600');
        $api_token=$this->roanuz_Auth();
        $ret=DB::table('football_match_player_point')->where(array("match_id"=>"1381498440328024066"))->get();
        foreach ($ret as $value) {
            $url="https://api.footballapi.com/v1/match/1381498440328024066?access_token=".$api_token."&card_type=summary_card";
            $data=Http::get($url);
            $live_score_player=$data['data']['players'];
            // return $live_score_player;
            // return $live_score_player;
            $player_id=$live_score_player[$value->player_id];
            // echo $player_id;
            $pd[]=$player_id;
            // $pdata[]=$obj;

            
            
        }
        // return $pd;
         foreach ($pd as  $p) {
            // echo json_encode($p['stats']['goal']['saved']);
            // return $p['stats']['clean_sheet'];
            foreach($p['stats']['goal'] as $pi)
            {
                return $pi['saved'];
            }
            //  echo json_encode($p);
             $req=array(
                 'in_bench_squad'=>$p['in_bench_squad'],
                 'in_playing_squad'=>$p['in_playing_squad'],
                 'name'=>$p['name'],
                 'RC'=>$p['stats']['card']['RC'],
                 'YC'=>$p['stats']['card']['YC'],
                 'Y2C'=>$p['stats']['card']['Y2C'],
                //  'clean_sheet'=>$p['stats']['clean_sheet'],
                 'goal_assist'=>$p['stats']['goal']['assist'],
                 'own_goal_conceded'=>$p['stats']['goal']['own_goal_conceded'],
                //  'goal_saved'=>$p['stats']['goal']['saved'],
                 'goal_scored'=>$p['stats']['goal']['scored'],
                 'minutes_played '=>$p['stats']['minutes_played'],
                //  'passes'=>$p['stats']['passes'],
                 'penalty_missed'=>$p['stats']['penalty']['missed'],
                 'penalty_saved'=>$p['stats']['penalty']['saved'],

             );

            //  DB::table('football_match_player_point')->where(array("player_id"=>$p['key']))->update(array("role"=>$p['role'],"point_details"=>$req));
            //  print_r($p['role']);
            // return $req;
            
         }
         
        //  return "success";
        

    }
        


    

}
