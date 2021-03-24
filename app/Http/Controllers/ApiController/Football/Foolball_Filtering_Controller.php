<?php

namespace App\Http\Controllers\ApiController\Football;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ApiModel\football\sportsmonk\sportsmonk_matchs;
use App\Models\ApiModel\football\sportsmonk\sportsmonk_match_teams;

use App\Models\ApiModel\football\roanuz\roanuz_matchs;
use App\Models\ApiModel\football\roanuz\roanuz_match_teams;

use App\Models\ApiModel\football\unique_data\unique_matchs;
use App\Models\ApiModel\football\unique_data\unique_teams;

class Foolball_Filtering_Controller extends Controller
{
    //
    public function filter_unique_match(){

        $roanuz_table=roanuz_matchs::get();

        unique_matchs::truncate();

        foreach($roanuz_table as $value){

            // return $value;
            $data = new unique_matchs;
            $data->match_key = $value->match_key;
            $data->match_away_team = $value->match_away_team;
            $data->match_home_team = $value->match_home_team;
            $data->match_name = $value->match_name;
            $data->match_short_name = $value->match_short_name;

            $data->match_start_date = $value->match_start_date;
            $data->match_start_time = $value->match_start_time;

            $data->match_status = $value->match_status;
            $data->match_result = $value->match_result;

            $data->tournament_key = $value->tournament_key;
            $data->tournament_name = $value->tournament_name;

            $data->API = "roanuz";
            $data->save();
        }

        $final_match_list=unique_matchs::get();
        $sportsmonk_match_list=sportsmonk_matchs::get();

        foreach($sportsmonk_match_list as $sportsmonk_match){


            $flag='';


            foreach($final_match_list as $final_match){

                similar_text(str_replace('vs', '',str_replace(' ', '', $sportsmonk_match->match_short_name)),str_replace('vs', '',str_replace(' ', '', $final_match->match_short_name)),$percent);

                // echo $percent."--> ".$sportsmonk_match->match_short_name." - ".$final_match->match_short_name." \n";
                // echo $percent."--> ".str_replace('vs', '',str_replace(' ', '', $sportsmonk_match->match_short_name))." - ".str_replace('vs', '',str_replace(' ', '', $final_match->match_short_name))." \n";

                if($percent<=90){
                    $flag='unique';
                }else{
                    $flag='duplicate';
                }

            }

            if($flag=='unique'){
                $data = new unique_matchs;
                $data->match_key = $sportsmonk_match->match_key;
                $data->match_away_team = $sportsmonk_match->match_away_team;
                $data->match_home_team = $sportsmonk_match->match_home_team;
                $data->match_name = $sportsmonk_match->match_name;
                $data->match_short_name = $sportsmonk_match->match_short_name;

                $data->match_start_date = $sportsmonk_match->match_start_date;
                $data->match_start_time = $sportsmonk_match->match_start_time;

                $data->match_status = $sportsmonk_match->match_status;
                $data->match_result = $sportsmonk_match->match_result;

                $data->tournament_key = $sportsmonk_match->tournament_key;
                $data->tournament_name = $sportsmonk_match->tournament_name;

                $data->API = "sportsmonk";
                $data->save();
            }

        }

        return response()->json("done");

    }

    public function filter_unique_team(){

       $sportsmonk_teams_table=sportsmonk_match_teams::get();
        $roanuz_teams_table=roanuz_match_teams::get();

        unique_teams::truncate();


        foreach($sportsmonk_teams_table as $value){
            $data = new unique_teams;
            $data->match_key = $value->fixture_id;
            $data->team_key = $value->team_id;
            $data->team_name = $value->name;
            $data->team_short_name = $value->short_code;
            $data->logo_path = $value->logo_path;
            $data->players = $value->players;
            $data->API = 'sportsmonk';
            $data->save();
        }

        foreach($roanuz_teams_table as $value){

            $data = new unique_teams;
            $data->match_key = $value->match_key;
            $data->team_key = $value->team_key;
            $data->team_name = $value->team_name;
            $data->team_short_name = $value->team_short_name;
            $data->logo_path = null;
            $data->players = $value->players;
            $data->API = 'roanuz';
            $data->save();
        }




        return response()->json("done");

    }


        //
    // public function filter_match1(){
    //     $final_match_list=final_match_list::select('match_short_name')->pluck('match_short_name')->toarray();
    //     $sportsmonk_match_list=sportsmonk_match_list::select('match_short_name')->pluck('match_short_name')->toarray();

    //     foreach($sportsmonk_match_list as $sportsmonk_match){

    //         if (!in_array($sportsmonk_match,$final_match_list)) {
    //             // echo "unique \n";
    //             foreach($final_match_list as $final_match){

    //                 similar_text(str_replace('vs', '',str_replace(' ', '', $sportsmonk_match)),str_replace('vs', '',str_replace(' ', '', $final_match)),$percent);
    //                 // echo $percent."--> ".$final_match." - ".$roanuz_match." \n";

    //                 echo $percent."--> ".str_replace('vs', '',str_replace(' ', '', $sportsmonk_match))." - ".str_replace('vs', '',str_replace(' ', '', $final_match))." \n";

    //             }
    //         }

    //         echo "\n \n";

    //     }
    // }



}
