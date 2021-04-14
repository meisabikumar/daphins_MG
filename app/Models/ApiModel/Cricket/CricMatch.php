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
    // get team id
    public function playerdata()
    {
        $ret=DB::table('cricket_fixture_teams')->select('team_id','players')->get();
        return $ret;
        // $ret=DB::table('cricket_fixture_teams')->distinct('team_id')->pluck('team_id');
        // return $ret;
    }
    public function getData()
    {
        $ret=DB::table('cricket_fixture_teams')->get();
        return $ret;
    }

    public function signup_model($data)
    {
        $data=(object)$data;
        $ret=DB::table('users')->insert(array('name'=>$data->name,
            'email'=>$data->email,
            'mobile'=>$data->mobile,
            'city'=>$data->city,
            'state'=>$data->state,
            'country'=>$data->country,
            'address'=>$data->address,
            'gender'=>$data->gender,
            'DOB'=>$data->DOB,
            'team_name'=>$data->team_name,
            'post_code'=>$data->post_code,
    ));
    return $ret;
    }
    public function getUserDataModel($email)
    {
        $ret=DB::table('users')->where(array("email"=>$email))->get();
        return $ret;
    }
    public function Cricket_User_Teams_Model($user_id,$team,$match_id)
    {

        $ret=DB::table('cric_user_team')->insert(array('user_id'=>$user_id,'teams'=>$team,'match_id'=>$match_id));
        return $ret;
    }
    public function Cricket_User_Teams_Model_get($id,$match_id)
    {
        $ret=DB::table('cric_user_team')->where(array("user_id"=>$id,"match_id"=>$match_id))->get();
        // $ret=DB::table('cric_user_team')->get();
        return $ret;

    } 
    public function Football_User_Teams_Model($user_id,$team,$match_id)
    {
        $ret=DB::table('football_user_team')->insert(array('user_id'=>$user_id,'teams'=>$team,'match_id'=>$match_id));
        return $ret;
    }
    public function Football_Teams_get($id,$match_id)
    {
        $ret=DB::table('football_user_team')->where(array("user_id"=>$id,"match_id"=>$match_id))->get();
        // $ret=DB::table('cric_user_team')->get();
        return $ret;
    }

}
