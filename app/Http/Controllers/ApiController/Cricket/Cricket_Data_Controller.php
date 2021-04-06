<?php

namespace App\Http\Controllers\ApiController\Cricket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\ApiModel\Cricket\cricket_fixture;
use App\Models\ApiModel\Cricket\cricket_fixture_teams;

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
        $api_token="Vs99FDycm6GHwRj4Cr9x67QC8d1S2ShJVQ7crytfZ7DBhrI4FFM1irajfKv3";

        $url="https://cricket.sportmonks.com/api/v2.0/fixtures?api_token=".$api_token."&filter[starts_between]=2021-03-01,2021-05-15&include=localteam,visitorteam";

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
            $data->localteam_data = $value['localteam'];
            $data->visitorteam_id = $value['visitorteam_id'];
            $data->visitorteam_data = $value['visitorteam'];
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

    public function cricket_fixture_teams(){


        $api_token = "Vs99FDycm6GHwRj4Cr9x67QC8d1S2ShJVQ7crytfZ7DBhrI4FFM1irajfKv3";

        $fixtures = cricket_fixture::get();

        cricket_fixture_teams::truncate();

        foreach ($fixtures as $fixture) {


            $localteam = "https://cricket.sportmonks.com/api/v2.0/teams/".$fixture['localteam_id']."?api_token=".$api_token."&include=squad";

            $localteam_res = Http::get($localteam);
            $localteam_data = $localteam_res["data"];

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

            // ---------------------------------
            $visitorteam = "https://cricket.sportmonks.com/api/v2.0/teams/" . $fixture['visitorteam_id'] . "?api_token=" . $api_token . "&include=squad";

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

        return "done";

    }
}
