<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\ApiModel\roanuz_tournaments;
use App\Models\ApiModel\roanuz_tournament_teams_details;
use App\Models\ApiModel\roanuz_tournament_rounds_list;
use App\Models\ApiModel\roanuz_match_list;
use App\Models\ApiModel\roanuz_team_players_details;

use DateTime;
use DateTimeZone;

class RoanuzApiController extends Controller
{
    //

    // Function to generate Api_access_token
    public function roanuzAuth()
    {
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

    // Function to get recent tournaments
    public function recent_tournaments(){


        //calling roanuzAuth() to get api_access token
        $api_token=$this->roanuzAuth();

        //Api Url
        $url="https://api.footballapi.com/v1/recent_tournaments/?access_token=".$api_token;

        //Response from Api
        $response = Http::get($url);

        //empty tournamnets table to avoid repeted data
        roanuz_tournaments::truncate();

        $start_date=date("Y-m-d");
        $date=date_create($start_date);
        date_add($date,date_interval_create_from_date_string("5 days"));
        $end_date=date_format($date,"Y-m-d");

        //Loop through recived data
        foreach ($response["data"]["tournaments"] as $value) {


            $tournament_start_date = new DateTime($value['start_date']['gmt'], new DateTimeZone('GMT'));
            $tournament_start_date = $tournament_start_date->setTimezone(new DateTimeZone('IST'))->format('Y-m-d');

            $tournament_end_date = new DateTime($value['end_date']['gmt'], new DateTimeZone('GMT'));
            $tournament_end_date = $tournament_end_date->setTimezone(new DateTimeZone('IST'))->format('Y-m-d');

            if($tournament_end_date >= $start_date){
                $data=new roanuz_tournaments;
                $data->tournament_key=$value['key'];
                $data->competition_key=$value['competition']['key'];
                $data->tournament_name=$value['name'];
                $data->tournament_short_name=$value['short_name'];
                $data->start_date=$tournament_start_date;
                $data->end_date = $tournament_end_date;
                $data->save();

            }
            // save Data to Database

        }

        return response()->json(['success' =>"saved"],200);

    }

    // Function to get Teams playing in tournaments
    public function tournament_teams_details(){

        // calling roanuzAuth() to get api_access token
        $api_token=$this->roanuzAuth();

        // get all the Tournaments from Database
        $tournaments=roanuz_tournaments::all();

        // empty Teams table to avoid repeted data
        roanuz_tournament_teams_details::truncate();

        // Loop through each tournaments present in database
        foreach ($tournaments as $value) {

            // Api Url
            $url="https://api.footballapi.com/v1/tournament/".$value["tournament_key"]."/?access_token=".$api_token;

            // response From Api
            $response = Http::get($url);


            // Loop through Teams playing in Tournament
            foreach ($response["data"]["tournament"]["teams"] as $value) {

                // Teams Data to Data Base
                $data=new roanuz_tournament_teams_details;
                $data->tournament_key=$response["data"]["tournament"]['key'];
                $data->tournament_name=$response["data"]["tournament"]['name'];
                $data->tournament_short_name=$response["data"]["tournament"]['short_name'];

                $start_date = new DateTime($response["data"]["tournament"]['start_date']['gmt'], new DateTimeZone('GMT'));
                $data->tournament_start_date=$start_date->setTimezone(new DateTimeZone('IST'))->format('Y-m-d');

                $end_date = new DateTime($response["data"]["tournament"]['end_date']['gmt'], new DateTimeZone('GMT'));
                $data->tournament_end_date=$end_date->setTimezone(new DateTimeZone('IST'))->format('Y-m-d');

                $data->competition_key=$response["data"]["tournament"]['competition']['key'];

                $data->team_key=$value['key'];
                $data->team_code=$value['code'];
                $data->team_name=$value['name'];
                $data->save();
            }

        }
        // return roanuz_tournament_teams_details::orderBy('team_code')->get();
        return response()->json(['success' =>"saved"],200);
    }

    public function tournament_rounds_list(){
        // calling roanuzAuth() to get api_access token
        $api_token=$this->roanuzAuth();

        // get all the Tournaments from Database
        $tournaments=roanuz_tournaments::all();

        // empty Teams table to avoid repeted data
        roanuz_tournament_rounds_list::truncate();



        // Loop through each tournaments present in database
        foreach ($tournaments as $value) {

            // Api Url
            $url="https://api.footballapi.com/v1/tournament/".$value["tournament_key"]."/?access_token=".$api_token;

            // response From Api
            $response = Http::get($url);

           foreach ($response["data"]["tournament"]["rounds"] as $value) {
            $data=new roanuz_tournament_rounds_list;
            $data->round_key=$value['key'];
            // $data->groups=$value['groups'];
            $data->round_name=$value['name'];
            $data->teams=$value['teams'];

            $data->tournament_key=$response["data"]["tournament"]['key'];
            $data->tournament_name=$response["data"]["tournament"]['name'];
            $data->tournament_short_name=$response["data"]["tournament"]['short_name'];

            $start_date = new DateTime($response["data"]["tournament"]['start_date']['gmt'], new DateTimeZone('GMT'));
            $data->tournament_start_date=$start_date->setTimezone(new DateTimeZone('IST'))->format('Y-m-d');

            $end_date = new DateTime($response["data"]["tournament"]['end_date']['gmt'], new DateTimeZone('GMT'));
            $data->tournament_end_date=$end_date->setTimezone(new DateTimeZone('IST'))->format('Y-m-d');
            $data->competition_key=$response["data"]["tournament"]['competition']['key'];

            $data->save();
           }

        }
        return response()->json(['success' =>"saved"],200);

    }

      // Function to get Players Playing in Teams
      public function match_list(){

        // calling roanuzAuth() to get api_access token
        $api_token=$this->roanuzAuth();

        //
        $rounds=roanuz_tournament_rounds_list::select('round_key','tournament_key')->get();

        //empty Players table to avoid repeted data
        roanuz_match_list::truncate();

        $start_date=date("Y-m-d");
        $date=date_create($start_date);
        date_add($date,date_interval_create_from_date_string("5 days"));
        $end_date=date_format($date,"Y-m-d");

        // Loop through Teams present in Database
        foreach ($rounds as $round) {

            // Api Url
            $url="https://api.footballapi.com/v1/tournament/".$round["tournament_key"]."/round-detail/".$round["round_key"]."/?access_token=".$api_token;

            // Response from Api
           $response = Http::get($url);


            // loop through players in Team
            foreach ($response["data"]["round"]["matches"] as $value) {

                $match_start_date = new DateTime($value['match']['start_date']['gmt'], new DateTimeZone('GMT'));
                $match_start_date = $match_start_date->setTimezone(new DateTimeZone('IST'))->format('Y-m-d');

                if ($match_start_date  >= $start_date && $match_start_date  <= $end_date ) {
                    // save players Data to Database
                $data=new roanuz_match_list;

                $data->match_key=$value['match']['key'];
                $data->match_away_team=$value['match']['away'];
                $data->match_home_team=$value['match']['home'];
                $data->match_name=$value['match']['name'];
                $data->match_short_name=$value['match']['short_name'];
                $data->match_start_date=$match_start_date;
                $data->match_status=$value['match']['status'];
                $data->match_result=$value['result']['title'];

                $data->round_key=$response["data"]["round"]['key'];
                $data->round_name=$response["data"]["round"]['name'];

                $data->tournament_key=$round["tournament_key"];


                $data->save();

                }


            }

        }

        return response()->json(['success' =>"saved"],200);
    }


    // Function to get Players Playing in Teams
    public function team_players_details(){

        // calling roanuzAuth() to get api_access token
        $api_token=$this->roanuzAuth();

        // get all the Teams from Database
        $teams=roanuz_tournament_teams_details::select('team_key','tournament_key')->groupBy('team_key')->get();

        //empty Players table to avoid repeted data
        roanuz_team_players_details::truncate();

        // Loop through Teams present in Database
        foreach ($teams as $value) {

            // Api Url
            $url="https://api.footballapi.com/v1/tournament/".$value["tournament_key"]."/team/".$value["team_key"]."/?access_token=".$api_token;

            // Response from Api
            $response = Http::get($url);

            // loop through players in Team
            foreach ($response["data"]["team"]["players"] as $value) {

                // save players Data to Database
                $data=new roanuz_team_players_details;
                $data->team_key=$response["data"]["team"]['key'];
                // $data->team_code=$value["data"]["team"]['code'];
                // $data->team_name=$value["data"]["team"]['name'];
                $data->player_key=$value['key'];
                $data->player_name=$value['name'];
                $data->player_role=$value['role'];
                $data->jersey_number=$value['jersey_number'];
                $data->jersey_name=$value['jersey_name'];
                $data->save();
            }

        }

        return response()->json(['success' =>"saved"],200);
    }

}
