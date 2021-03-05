<?php

namespace App\Models\ApiModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class MatchesModel extends Model
{
    use HasFactory;

   public function getTeamOne_Model()
   {
       $ret=DB::table('fixture')->get();
    //    $ret=DB::table('fixture')->select('localteam_id')->get();
       return $ret;
   }
   public function TeamsModel($data)
   {
       $data=(object)$data;
       $ret=DB::table('teams')->insert(array(
            'teamId'=>$data->id,
            'legacy_id'=>$data->legacy_id,
            'name'=>$data->name,
            'short_code'=>$data->short_code,
            'twitter'=>$data->twitter,
            'country_id'=>$data->country_id,
            'national_team'=>$data->national_team,
            'founded'=>$data->founded,
            'logo_path'=>$data->logo_path,
            'venue_id'=>$data->venue_id,
            'current_season_id'=>$data->current_season_id,

       ));
       return $ret;
        // echo $data->id."<br>";
    // return $data['id'];
   }
   public function TeamsModelTwo($data)
   {
    $data=(object)$data;
    $rt=DB::table('teams')->insert(array(
         'teamId'=>$data->id,
         'legacy_id'=>$data->legacy_id,
         'name'=>$data->name,
         'short_code'=>$data->short_code,
         'twitter'=>$data->twitter,
         'country_id'=>$data->country_id,
         'national_team'=>$data->national_team,
         'founded'=>$data->founded,
         'logo_path'=>$data->logo_path,
         'venue_id'=>$data->venue_id,
         'current_season_id'=>$data->current_season_id,

    ));
    return $rt;
   }
}
