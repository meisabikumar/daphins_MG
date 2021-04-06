<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ApiModel\FixtureModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Models\ApiModel\MatchesModel;
use App\Models\ApiModel\sportsmonk_match_list;


class MatchesController extends Controller
{
    public function getTeamone()
    {
        // Model Object
        $MatchMdel=new MatchesModel();
        $api_token="CcP4ZFsZBYTETwlUf96ICZwMccTk5NJVXlq2meeTzAI2gD3gOt89moKYy5uD";
        // Fetching Team ID
        $res=$MatchMdel->getTeamOne_Model();

        // $url="https://soccer.sportmonks.com/api/v2.0/teams/:Team_id"

        foreach ($res as $value) {
            // Team One
            $teamOneId=$value->localteam_id;
            $url="https://soccer.sportmonks.com/api/v2.0/teams/".$teamOneId."?api_token=".$api_token;
            $response = Http::get($url);
            // Object of response for team 1
            $resobj=json_decode($response,true);
            $team_res=$MatchMdel->TeamsModel($resobj['data']);
            // Team Two
            $teamTwoId=$value->visitorteam_id;
            $urlTwo="https://soccer.sportmonks.com/api/v2.0/teams/".$teamTwoId."?api_token=".$api_token;
            $response_two = Http::get($urlTwo);
            // Object of response for team 2
            $resobj_two=json_decode($response_two,true);
            $team_res_two=$MatchMdel->TeamsModelTwo($resobj_two['data']);
        }
        if($team_res>0 && $team_res_two>0)
            {
                return response('Success', 200)->header('Content-Type', 'application/json');
            }else{
                return response('Fail', 401)->header('Content-Type', 'application/json');
            }



    }

    public function sportsmonk_match_list(){

        $api_token="CcP4ZFsZBYTETwlUf96ICZwMccTk5NJVXlq2meeTzAI2gD3gOt89moKYy5uD";

      $fixtures=FixtureModel::get();

       sportsmonk_match_list::truncate();


        foreach($fixtures as $fixture){

            $localteam="https://soccer.sportmonks.com/api/v2.0/teams/".$fixture['localteam_id']."?api_token=".$api_token;
            $visitorteam="https://soccer.sportmonks.com/api/v2.0/teams/".$fixture['visitorteam_id']."?api_token=".$api_token;

            // Response
            $localteam_res = Http::get($localteam);
            $visitorteam_res = Http::get($visitorteam);

            $data=new sportsmonk_match_list;
            $data->fixture_id= $fixture['fixture_id'];
            $data->league_id= $fixture['league_id'];
            $data->season_id= $fixture['season_id'];
            $data->round_id= $fixture['round_id'];
            $data->group_id= $fixture['group_id'];

            $data->match_home_team= $fixture['localteam_id'];
            $data->match_away_team= $fixture['visitorteam_id'];

            $data->match_name=$localteam_res['data']['name']." vs ".$visitorteam_res['data']['name'];
            $data->match_short_name= $localteam_res['data']['short_code']." vs ".$visitorteam_res['data']['short_code'];
            $date=date_create($fixture['starting_date']);
            $data->match_start_date= date_format($date,"Y-m-d");
            $data->match_start_time= $fixture['starting_time'];

            $data->save();
        }

        return "done";
    }





    // Testing Algoritham
    // Match Feeding Algo
    public function TestAlgo()
    {
        $date_one="10-10-2021";
        $date_two="10-10-2021";
        // using Short Name of Team
        $teamOne="INDIA";
        $teamTwo="ndia";

        $comp=strcasecmp($teamOne,$teamTwo);
        if($date_one==$date_two)
        {
            if($comp==0)
        {
            return "Same Hai";

        }else{

            return "Everything is fine date is same but match is not present";
        }
        }else{
                return "Date same nai hai, so we can add match";
        }

    }



}
