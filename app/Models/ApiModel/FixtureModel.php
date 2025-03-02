<?php

namespace App\Models\ApiModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class FixtureModel extends Model
{
    use HasFactory;

    protected $table = 'fixture';

    public function getFixtureModel($data,$time)
    {
        // Object of array
        // $$time=(object)$time;
        $date=strtotime($time['starting_date']);
		$starting_date=date('d-m-Y',$date);
        $data=(object)$data;
        // Inserting data
        $ret=DB::table('fixture')->insert(array(
            'fixture_id'=>$data->id,
            'league_id'=>$data->league_id,
            'season_id'=>$data->season_id,
            'stage_id'=>$data->stage_id,
            'round_id'=>$data->round_id,
            'group_id'=>$data->group_id,
            'aggregate_id'=>$data->aggregate_id,
            'venue_id'=>$data->referee_id,
            'localteam_id'=>$data->localteam_id,
            'visitorteam_id'=>$data->visitorteam_id,
            'winner_team_id'=>$data->winner_team_id,
            'commentaries'=>$data->commentaries,
            'attendance'=>$data->attendance,
            'pitch'=>$data->pitch,
            'details'=>$data->details,
            'neutral_venue'=>$data->neutral_venue,
            'leg'=>$data->leg,
            'colors'=>$data->colors,
            'deleted'=>$data->deleted,
            'status'=>$time['status'],
            'starting_date'=>$starting_date,
            'starting_time'=>$time['starting_time'],

        ));
        return $ret;


    }

}
