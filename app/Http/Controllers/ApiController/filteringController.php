<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiModel\sportsmonk_match_list;
use App\Models\ApiModel\roanuz_match_list;
use App\Models\ApiModel\final_match_list;



class filteringController extends Controller
{

    public function filter_match(){

        $roanuz_table=roanuz_match_list::get();

        final_match_list::truncate();


        foreach($roanuz_table as $value){

            // return $roanuz_table;
            $data = new final_match_list;
            $data->match_key = $value->match_key;
            $data->match_away_team = $value->match_away_team;
            $data->match_home_team = $value->match_home_team;
            $data->match_name = $value->match_name;
            $data->match_short_name = $value->match_short_name;
            $data->match_start_date = $value->match_start_date;
            $data->match_start_time = $value->match_start_time;
            $data->API = "roanuz";
            $data->save();
        }


        $final_match_list=final_match_list::get();
        $sportsmonk_match_list=sportsmonk_match_list::get();

        foreach($sportsmonk_match_list as $sportsmonk_match){

                $flag='';


                foreach($final_match_list as $final_match){

                    similar_text(str_replace('vs', '',str_replace(' ', '', $sportsmonk_match->match_short_name)),str_replace('vs', '',str_replace(' ', '', $final_match->match_short_name)),$percent);

                    // echo $percent."--> ".$sportsmonk_match->match_short_name." - ".$final_match->match_short_name." \n";
                    echo $percent."--> ".str_replace('vs', '',str_replace(' ', '', $sportsmonk_match->match_short_name))." - ".str_replace('vs', '',str_replace(' ', '', $final_match->match_short_name))." \n";

                    if($percent<=90){
                        $flag='unique';
                    }else{
                        $flag='duplicate';
                    }

                }

                if($flag=='unique'){
                    $data = new final_match_list;
                    $data->match_key = $sportsmonk_match->match_key;
                    $data->match_away_team = $sportsmonk_match->match_away_team;
                    $data->match_home_team = $sportsmonk_match->match_home_team;
                    $data->match_name = $sportsmonk_match->match_name;
                    $data->match_short_name = $sportsmonk_match->match_short_name;
                    $data->match_start_date = $sportsmonk_match->match_start_date;
                    $data->match_start_time = $sportsmonk_match->match_start_time;
                    $data->API = "sportsmonk";
                    $data->save();
                }

        }


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
