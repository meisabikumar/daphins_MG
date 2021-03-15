<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ApiModel\FixtureModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Models\ApiModel\PlayerModel;

class PlayerController extends Controller
{

    public function getPlayer()
    {
        // Api Token
        $api_token="CcP4ZFsZBYTETwlUf96ICZwMccTk5NJVXlq2meeTzAI2gD3gOt89moKYy5uD";
        // Fetching Team ID
        $PlayerModel=new PlayerModel();
        $result_team=$PlayerModel->getTeam();
        foreach($result_team as $rt)
        {
            $team_id=$rt->teamId;
            // Hitting Api
            $url="https://soccer.sportmonks.com/api/v2.0/teams/".$team_id."?api_token=".$api_token."&include=squad.player";
            // Response of Api
            $response = Http::withToken($api_token)->get($url);

            // return $response;
            foreach($response['data']['squad']['data'] as $dt)
            {

                $result_player=$PlayerModel->PlayerDataModel($dt['player']['data']);

            }
            if($result_player>0)
            {
                return response('Success', 200)->header('Content-Type', 'application/json');
            }else{
                return response('Fail', 401)->header('Content-Type', 'application/json');
            }
        }

    }

}
