<?php

namespace App\Http\Controllers\ApiController\Cricket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ApiModel\Cricket\cricket_fixture;
use App\Models\ApiModel\Cricket\cricket_all_teams;

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

}
