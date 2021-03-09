<?php

namespace App\Models\ApiModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PlayerModel extends Model
{
    use HasFactory;

    public function getTeam()
    {
        $ret=DB::table('teams')->get();
        return $ret;
    }
    public function PlayerDataModel($data)
    {
        
        $ret=DB::table('players')->insert(array(
            'player_id'=>$data['player_id'],
            'team_id'=>$data['team_id'],
            'country_id'=>$data['country_id'],
            'position_id'=>$data['position_id'],
            'common_name'=>$data['common_name'],

            'display_name'=>$data['display_name'],
            'fullname'=>$data['fullname'],
            'firstname'=>$data['firstname'],
            'lastname'=>$data['lastname'],
            'nationality'=>$data['nationality'],
            'birthdate'=>$data['birthdate'],
            'birthcountry'=>$data['birthcountry'],
            'birthplace'=>$data['birthplace'],
            'height'=>$data['height'],
            'weight'=>$data['weight'],
            'image_path'=>$data['image_path']
        ));
        return $ret;
    }
    public function PlayerData()
    {
        $ret=DB::table('players')->get();
        return $ret;
    }   
}
