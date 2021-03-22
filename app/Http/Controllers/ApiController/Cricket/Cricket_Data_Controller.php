<?php

namespace App\Http\Controllers\ApiController\Cricket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\ApiModel\Cricket\cricket_fixture;
use App\Models\ApiModel\Cricket\cricket_all_teams;

class Cricket_Data_Controller extends Controller
{
    //
    public function fixtures(){

        //empty tournamnets table to avoid repeted data
        cricket_fixture::truncate();

        $start_date=date("Y-m-d");
        $date=date_create($start_date);
        date_add($date,date_interval_create_from_date_string("5 days"));
        $end_date=date_format($date,"Y-m-d");

         // Api token
        $api_token="CcP4ZFsZBYTETwlUf96ICZwMccTk5NJVXlq2meeTzAI2gD3gOt89moKYy5uD";

        $url="https://cricket.sportmonks.com/api/v2.0/fixtures?api_token=".$api_token."&filter[starts_between]=2021-03-01,2021-03-28";

        //Response from Api
        $response = Http::get($url);

        foreach($response['data'] as $value){

            $data = new cricket_fixture;
            $data->fixture_id = $value['id'];
            $data->league_id = $value['league_id'];
            $data->season_id = $value['season_id'];
            $data->stage_id = $value['stage_id'];
            $data->round = $value['round'];
            $data->localteam_id = $value['localteam_id'];
            $data->visitorteam_id = $value['visitorteam_id'];
            $data->starting_at = $value['starting_at'];
            $data->type = $value['type'];
            $data->live = $value['live'];
            $data->status = $value['status'];
            $data->last_period = $value['last_period'];
            $data->note = $value['note'];
            $data->venue_id = $value['venue_id'];
            $data->toss_won_team_id = $value['toss_won_team_id'];
            $data->winner_team_id = $value['winner_team_id'];
            $data->draw_noresult = $value['draw_noresult'];
            $data->man_of_match_id = $value['man_of_match_id'];
            $data->man_of_series_id = $value['man_of_series_id'];
            $data->total_overs_played = $value['total_overs_played'];
            $data->elected = $value['elected'];
            $data->super_over = $value['super_over'];
            $data->follow_on = $value['follow_on'];
            $data->localteam_dl_data = $value['localteam_dl_data'];
            $data->visitorteam_dl_data = $value['visitorteam_dl_data'];
            $data->rpc_overs = $value['rpc_overs'];
            $data->rpc_target = $value['rpc_target'];
            // $data->weather_report = $value['weather_report'];
            $data->save();


        }
        return "done";




    }

    public function all_teams(){

        //empty tournamnets table to avoid repeted data
        cricket_all_teams::truncate();

         // Api token
        $api_token="CcP4ZFsZBYTETwlUf96ICZwMccTk5NJVXlq2meeTzAI2gD3gOt89moKYy5uD";

        $url="https://cricket.sportmonks.com/api/v2.0/teams?api_token=".$api_token;

        //Response from Api
        $response = Http::get($url);




        foreach($response['data'] as $value){


            $team=cricket_all_teams::where('team_id',$value['id'])->first();

            if(!$team){
               $data = new cricket_all_teams;
               $data->team_id = $value['id'];
               $data->name = $value['name'];
               $data->code = $value['code'];
               $data->image_path = $value['image_path'];
               $data->country_id = $value['country_id'];
               $data->national_team = $value['national_team'];
               $data->save();
            }



        }
        return "done";

    }
}
