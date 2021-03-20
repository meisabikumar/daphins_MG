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

use App\Models\ApiModel\final_match_list;
use App\Models\ApiModel\final_team_list;

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
        $data=final_match_list::all();

        $result = array();

        foreach($data as $val){
            $arr = array(
            "id"=> $val->id,
            "title"=> $val->match_name,
            "short_title" => $val->match_short_name,
            "start_date" => $val->match_start_date,
            "start_time" => $val->match_start_time);
            $result[]=$arr;
        }
        // var_dump($result);
        // $result_json = json_encode($result);

        return response()->json([
            "status"=>1,
            "message"=>"Success",
            "result"=>$result
        ]);
    }

    public function TeamDataRes()
    {
        $data=final_team_list::all();
        return response()->json($data);
    }

}
