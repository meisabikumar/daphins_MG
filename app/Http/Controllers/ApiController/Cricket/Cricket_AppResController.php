<?php

namespace App\Http\Controllers\ApiController\Cricket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ApiModel\Cricket\cricket_fixture;
use App\Models\ApiModel\Cricket\cricket_all_teams;

use App\Models\AdminModel\Cricket\cricket_contest;

class Cricket_AppResController extends Controller
{
    //

    public function MatchDataRes()
    {

     $data=cricket_fixture::all();


        $result = array();

        foreach($data as $val){

            // return $val;

            $visitorteam =cricket_all_teams::where('team_id',$val->visitorteam_id)->first();
            $localteam = cricket_all_teams::where('team_id',$val->localteam_id)->first();

            $arr = array(
                "id"=> $val->id,
                "fixture_id"=> $val->fixture_id,
                "title"=>$visitorteam->name." Vs ".$localteam->name,
                "short_title" => $visitorteam->code." Vs ".$localteam->code,
                "type" =>$val->type,
                "start_date" => $val->starting_at,

                "teams"=>array(
                    array(
                        "team_id"=>$visitorteam->id,
                        "name"=>$visitorteam->name,
                        "flag"=>$visitorteam->image_path),
                        array(
                            "team_id"=>$localteam->id,
                            "name"=>$localteam->name,
                            "flag"=>$localteam->image_path))

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
    }

    public function cricket_contest_response(Request $request){

       $data = cricket_contest::where('match_id',$request->match_id)->get();

        if(!$data){
            return response()->json([
                "message"=>"No Contest Available"
            ]);
        }


        $match=cricket_fixture::where('fixture_id',$request->match_id)->first();

            $visitorteam =cricket_all_teams::where('team_id',$match->visitorteam_id)->first();
            $localteam = cricket_all_teams::where('team_id',$match->localteam_id)->first();

            $series_data = array(
                "id"=> $match->id,
                "fixture_id"=> $match->fixture_id,
                "title"=>$visitorteam->name." Vs ".$localteam->name,
                "short_title" => $visitorteam->code." Vs ".$localteam->code,
                "type" =>$match->type,
                "start_date" => $match->starting_at,

                "teams"=>array(
                    array(
                        "team_id"=>$visitorteam->id,
                        "name"=>$visitorteam->name,
                        "flag"=>$visitorteam->image_path),
                        array(
                            "team_id"=>$localteam->id,
                            "name"=>$localteam->name,
                            "flag"=>$localteam->image_path))

            );

            return response()->json([
                "status"=>1,
                "message"=>"Success",
                "result"=>$data,
                "series_data"=>$series_data
            ]);


    }




}
