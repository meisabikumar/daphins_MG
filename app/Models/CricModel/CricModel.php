<?php

namespace App\Models\CricModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CricModel extends Model
{
    use HasFactory;

    // get Cricket categories
    public function ContestgetCategory()
    {
        $ret=DB::table('contest_categories')->get();
        return $ret;
    }
    // Team Name from cricket fixture table
    public function Contestgetseries()
    {
        $ret=DB::table('cricket_fixtures')->get();
        return $ret;
        
    }

}
