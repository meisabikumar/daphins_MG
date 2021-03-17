<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiModel\sportsmonk_match_list;
use App\Models\ApiModel\roanuz_match_list;

class filteringController extends Controller
{
    //
    public function filter_match(){
        $roanuz=roanuz_match_list::select('match_short_name')->pluck('match_short_name')->toarray();
         $sportsmonk=sportsmonk_match_list::select('match_short_name')->pluck('match_short_name')->toarray();

    //    return  $roanuz->count();

        foreach($roanuz as $match1){
            $match1;
            if (!in_array($match1,$sportsmonk)) {
                // echo "unique \n";
                foreach($sportsmonk as $match2){

                    similar_text(str_replace('vs', '',str_replace(' ', '', $match1)),str_replace('vs', '',str_replace(' ', '', $match2)),$percent);
                    // echo $percent."--> ".$match1." - ".$match2." \n";

                    echo $percent."--> ".str_replace('vs', '',str_replace(' ', '', $match1))." - ".str_replace('vs', '',str_replace(' ', '', $match2))." \n";

                }
            }

            echo "\n \n";

        }
    }
}
