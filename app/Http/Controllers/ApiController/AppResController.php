<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ApiModel\FixtureModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Models\ApiModel\PlayerModel;
use App\Models\ApiModel\MatchesModel;

class AppResController extends Controller
{
    
    public function FixtureRes()
    {
        $MatchesModel=new MatchesModel();
        $res=$MatchesModel->getTeamOne_Model();   
        $resobj=json_encode($res);
        return $resobj;
    }
    public function TeamRes()
    {
        $MatchesModel=new MatchesModel();
        $res=$MatchesModel->TeamData();
        $resobj=json_encode($res);
        return $resobj;
    }
    public function PlayerRes()
    {
        $PlayerModel=new PlayerModel();
        $res=$PlayerModel->PlayerData();
        $resobj=json_encode($res);
        return $resobj;
    }
}
