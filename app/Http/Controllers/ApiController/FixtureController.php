<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ApiModel\FixtureModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


class FixtureController extends Controller
{
    public function getFixtureByRange()
    {
        // Api token
        $api_token="CcP4ZFsZBYTETwlUf96ICZwMccTk5NJVXlq2meeTzAI2gD3gOt89moKYy5uD";
        // Date Automatation
        $start_date=date("Y-m-d");
        $date=date_create($start_date);
        date_add($date,date_interval_create_from_date_string("5 days"));
        $end_date=date_format($date,"Y-m-d");
        // Http Clinet Response
        $url="https://soccer.sportmonks.com/api/v2.0/fixtures/between/".$start_date."/".$end_date."?api_token=".$api_token;
        // $url="https://soccer.sportmonks.com/api/v2.0/fixtures/between/".$start_date."/".$end_date;

        // Response
        $response = Http::get($url);
        // return $response = Http::withToken($api_token)->get($url);

        // Feeding Data in Database
        foreach ($response['data'] as $value) {
            // Model Obeject
            $FixtureModel=new FixtureModel();
            // Model Function Call
            // return $value['time'];
            // $value['time']['starting_at']['date_time'];
            // return $value['time']['status'];

            $time=array(
                'status'=>$value['time']['status'],
                'starting_date'=>$value['time']['starting_at']['date'],
                "starting_time"=>$value['time']['starting_at']['time'],
            );
                // print_r($time['data_time']);
                // return $time['date_time'];
            $res=$FixtureModel->getFixtureModel($value,$time);
            // $res=$FixtureModel->getFixtureModel($time);

        }
        // Checking data feeding
        if($res>0)
        {
            return response('Success', 200)->header('Content-Type', 'application/json');
        }
        else{
            return response('Fail', 401)->header('Content-Type', 'application/json');
        }


    }


}
