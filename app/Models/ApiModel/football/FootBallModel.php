<?php

namespace App\Models\ApiModel\football;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class FootBallModel extends Model
{
    use HasFactory;

    public function getleaderboardModel($contest_id)
    {
        $ret=DB::table('football_user_contest_rank')->where(array("contest_id"=>$contest_id))->get();
        return $ret;
    }
    // public function player_point_Model($data)
    // {
    //     $data=(object)$data;

    //     $ret=DB::table('football_match_player_point')->insert(array("match_id"=>$data->match_id,"player_id"=>$data->player_id,"points"=>$data->points));
    //     return $ret;
    // }
    public function match_data()
    {
        // $ret=DB::table('unique_matchs')->where(array("Api"=>"roanuz","match_start_date"=>date("Y-m-d")))->get();
        $ret=DB::table('unique_matchs')->where(array("Api"=>"roanuz","match_start_date"=>"2021-04-21"))->get();
        return $ret;
        

        
    }
    
}
