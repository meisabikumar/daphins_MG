<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ApiModel\FixtureModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Models\ApiModel\MatchesModel;

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
            $url="https://soccer.sportmonks.com/api/v2.0/teams/".$teamOneId;
            $response = Http::withToken($api_token)->get($url);
            // Object of response for team 1
            $resobj=json_decode($response,true);
            $team_res=$MatchMdel->TeamsModel($resobj['data']);
            // Team Two
            $teamTwoId=$value->visitorteam_id;
            $urlTwo="https://soccer.sportmonks.com/api/v2.0/teams/".$teamTwoId;
            $response_two = Http::withToken($api_token)->get($urlTwo);
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
    // Testing Algoritham
    public function TestAlgo()
    {
        $date_one="10-10-2021";
        $date_two="10-10-2021";
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
