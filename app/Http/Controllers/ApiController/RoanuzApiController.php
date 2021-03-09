<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\ApiModel\roanuz_tournaments;
use App\Models\ApiModel\roanuz_tournament_teams_details;
use App\Models\ApiModel\roanuz_team_players_details;

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

        //Loop through recived data
        foreach ($response["data"]["tournaments"] as $value) {

            // save Data to Database
            $data=new roanuz_tournaments;
            $data->tournament_key=$value['key'];
            $data->name=$value['name'];
            $data->short_name=$value['short_name'];
            $data->start_date=$value['start_date']['gmt'];
            $data->end_date=$value['end_date']['gmt'];
            $data->competition_key=$value['competition']['key'];
            $data->save();
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
                $data->team_key=$value['key'];
                $data->team_code=$value['code'];
                $data->team_name=$value['name'];
                $data->save();
            }

        }
        // return roanuz_tournament_teams_details::orderBy('team_code')->get();
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
