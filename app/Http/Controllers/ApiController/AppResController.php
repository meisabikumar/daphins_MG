<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ApiModel\FixtureModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Models\ApiModel\PlayerModel;
use App\Models\ApiModel\MatchesModel;

use App\Models\ApiModel\football\unique_data\unique_matchs;
use App\Models\ApiModel\football\unique_data\unique_teams;
class AppResController extends Controller
{

    public function FixtureRes()
    {
        $MatchesModel=new MatchesModel();
        $res=$MatchesModel->getTeamOne_Model();
        $resobj=json_encode($res);
        return $resobj;
    }
    public function TeamRes()
    {
        $MatchesModel=new MatchesModel();
        $res=$MatchesModel->TeamData();
        $resobj=json_encode($res);
        return $resobj;
    }
    public function PlayerRes()
    {
        $PlayerModel=new PlayerModel();
        $res=$PlayerModel->PlayerData();
        $resobj=json_encode($res);
        return $resobj;
    }


    public function MatchDataRes()
    {
        $data=unique_matchs::all();

        $result = array();

        $array=array("Ligue 1","Bundesliga","Premier League","Champions League","LaLiga","Serie A","UEFA Nations League","Europa League","FIFA World Cup");

        foreach($data as $val){
            $k = array_rand($array);
            $v = $array[$k];

            $arr = array(
            "id"=> $val->id,
            "title"=> $val->match_name,
            "short_title" => $val->match_short_name,
            "start_date" => $val->match_start_date." ". $val->match_start_time,
            "type"=> $v
            );
            $result[]=$arr;
        }
        // var_dump($result);
        // $result_json = json_encode($result);

        return response()->json([
            "status"=>1,
            "message"=>"Success",
            "result"=>$result
        ]);
        // --------------
    }

    public function TeamDataRes()
    {
        $data=unique_teams::all();
        return response()->json($data);
    }

}
