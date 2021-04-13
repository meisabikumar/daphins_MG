<?php

namespace App\Models\ApiModel\Cricket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CricMatch extends Model
{
    use HasFactory;

    public function getlocalteam($id)
    {
        $ret=DB::table('cricket_fixture_teams')->where(array('team_id'=>$id))->get();
        return $ret;
    }
    public function getvisitorteam($id)
    {
        $ret=DB::table('cricket_fixture_teams')->where(array('team_id'=>$id))->get();
        return $ret;
    }
    public function getplayer_cric()
    {
        $ret=DB::table('cricket_fixture_teams')->get();
        return $ret; 
    }
    public function contest_detail_model($id)
    {
        $ret=DB::table('cricket_contests')->where(array('id'=>$id))->get();
        return $ret;
    }
    public function usercontestModel($data)
    {
        $data=(object)$data;
        $ret=DB::table('user_contests')->insert(array("user_id"=>$data->user_id,"contest_id"=>$data->contest_id,"match_id"=>$data->match_id,"game_type"=>$data->game_type,"entry_fee"=>$data->entry_fee))->get();
        return $ret;
    }

}
