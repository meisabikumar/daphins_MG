<?php

namespace App\Models\ApiModel\football\sportsmonk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sportsmonk_match_teams extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'players' => 'array',
    ];
    public function newgetvisitor($team_key)
    {
        $ret=DB::table('sportsmonk_match_teams')->where(array("team_id"=>$team_key))->get();
        return $ret;
    }
    public function newgetLocal($team_key)
    {
        $ret=DB::table('sportsmonk_match_teams')->where(array("team_id"=>$team_key))->get();
        return $ret;
    }
}
