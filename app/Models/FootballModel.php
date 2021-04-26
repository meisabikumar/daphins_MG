<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballModel extends Model
{
    use HasFactory;

    // get football categories
    public function ContestgetCategory()
    {
        $ret=DB::table('contest_categories')->get();
        return $ret;
    }
    // Team Name from football fixture table
    public function Contestgetseries()
    {
        $ret=DB::table('unique_matchs')->get();
        return $ret;

    }
}
