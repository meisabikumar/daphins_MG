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

use App\Models\ApiModel\football\roanuz\roanuz_match_teams;
use App\Models\ApiModel\sportsmonk_team_list;

use App\Models\ApiModel\football\unique_data\unique_matchs;
use App\Models\ApiModel\football\unique_data\unique_teams;

use App\Models\AdminModel\Football\football_contest;



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

        // $array=array("Ligue 1","Bundesliga","Premier League","Champions League","LaLiga","Serie A","UEFA Nations League","Europa League","FIFA World Cup");

        foreach($data as $val){
            // $k = array_rand($array);
            // $v = $array[$k];

            if($val->API=='roanuz'){
               $visitorteam =  roanuz_match_teams::where('team_key',$val->match_away_team)->first();
                $localteam =  roanuz_match_teams::where('team_key',$val->match_home_team)->first();

                $teams = array(
                    array(
                        "id"=>$visitorteam->id,
                        "team_id"=>$visitorteam->team_key,
                        "name"=>$visitorteam->team_name,
                        "short_name"=>$visitorteam->team_short_name,
                        "flag"=>null),
                        array(
                            "id"=>$localteam->id,
                            "team_id"=>$localteam->team_key,
                            "name"=>$localteam->team_name,
                            "short_name"=>$localteam->team_short_name,
                            "flag"=>null));
            }

            if($val->API=='sportsmonk'){
                // return  $val->match_away_team;
                $visitorteam =  sportsmonk_team_list::where('teamId',$val->match_away_team)->first();
                $localteam =  sportsmonk_team_list::where('teamId',$val->match_home_team)->first();

                $teams = array(
                    array(
                        "id"=>$visitorteam->id,
                        "team_id"=>$visitorteam->teamId,
                        "name"=>$visitorteam->name,
                        "short_name"=>$visitorteam->short_code,
                        "flag"=>$visitorteam->logo_path),
                        array(
                            "id"=>$localteam->id,
                            "team_id"=>$localteam->teamId,
                            "name"=>$localteam->name,
                            "short_name"=>$localteam->short_code,
                            "flag"=>$localteam->logo_path));
            }

            $arr = array(
                    "id"=> $val->id,
                    "match_key"=> $val->match_key,
                    "title"=> $val->match_name,
                    "short_title" => $val->match_short_name,
                    "start_date" => $val->match_start_date." ". $val->match_start_time,
                    "type"=> $val->tournament_name,
                    "teams"=>$teams,
                    "API"=> $val->API);

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

    public function football_contest_response(Request $request){
       $data = football_contest::where('match_id',$request->match_id)->get();

       if(!$data){
            return response()->json([
                "message"=>"No Contest Available"
            ]);
       }

       $match = unique_matchs::where('match_key',$request->match_id)->first();

        if($match->API=='roanuz'){
            $visitorteam =  roanuz_match_teams::where('team_key',$match->match_away_team)->first();
         $localteam =  roanuz_match_teams::where('team_key',$match->match_home_team)->first();

         $teams = array(
             array(
                 "id"=>$visitorteam->id,
                 "team_id"=>$visitorteam->team_key,
                 "name"=>$visitorteam->team_name,
                 "short_name"=>$visitorteam->team_short_name,
                 "flag"=>null),
                 array(
                     "id"=>$localteam->id,
                     "team_id"=>$localteam->team_key,
                     "name"=>$localteam->team_name,
                     "short_name"=>$localteam->team_short_name,
                     "flag"=>null));
        }

        if($match->API=='sportsmonk'){
            // return  $val->match_away_team;
            $visitorteam =  sportsmonk_team_list::where('teamId',$match->match_away_team)->first();
            $localteam =  sportsmonk_team_list::where('teamId',$match->match_home_team)->first();

            $teams = array(
                array(
                    "id"=>$visitorteam->id,
                    "team_id"=>$visitorteam->teamId,
                    "name"=>$visitorteam->name,
                    "short_name"=>$visitorteam->short_code,
                    "flag"=>$visitorteam->logo_path),
                    array(
                        "id"=>$localteam->id,
                        "team_id"=>$localteam->teamId,
                        "name"=>$localteam->name,
                        "short_name"=>$localteam->short_code,
                        "flag"=>$localteam->logo_path));
        }

        $series_data = array(
                "id"=> $match->id,
                "match_key"=> $match->match_key,
                "title"=> $match->match_name,
                "short_title" => $match->match_short_name,
                "start_date" => $match->match_start_date." ". $match->match_start_time,
                "type"=> $match->tournament_name,
                "teams"=>$teams,
                "API"=> $match->API);

        return response()->json([
            "status"=>1,
            "message"=>"Success",
            "result"=>$data,
            "series_data"=>$series_data
        ]);
    }

}
