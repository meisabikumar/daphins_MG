<?php

namespace App\Models\ApiModel\football\roanuz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class roanuz_match_teams extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'players' => 'array',
    ];
    public function getVisitor($team_key)
    {
        $ret=DB::table('roanuz_match_teams')->where(array("team_key"=>$team_key))->get();
        return $ret;
    }
    public function getLocal($team_key)
    {
        $ret=DB::table('roanuz_match_teams')->where(array("team_key"=>$team_key))->get();
        return $ret;
    }
}
