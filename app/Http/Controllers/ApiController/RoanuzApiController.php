<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\ApiModel\roanuz_tournaments;

class RoanuzApiController extends Controller
{
    //

    public function roanuzAuth()
    {
        $response = Http::post('https://api.footballapi.com/v1/auth/', [
            'access_key' => '72f44464a24650ee6c0da5ee93ce5ecd',
            'secret_key' => 'ae8dee4499e678bef75682d709279550',
            'app_id' => 'com.saisupp',
            'device_id' => 'developer',
        ]);

        if($response->successful()){
           return $api_access_token = $response["auth"]["access_token"];
        }else{
            return response()->json(['error' =>"error"],400);
        }

            // https://api.footballapi.com/v1/recent_tournaments/?access_token=2s1356950676474826774s1368100798067775775
    }

    public function recent_tournaments(){

     $api_token=$this->roanuzAuth();



        $url="https://api.footballapi.com/v1/recent_tournaments/?access_token=".$api_token;

        $response = Http::get($url);

        // return $response["data"]["tournaments"];
        roanuz_tournaments::truncate();

        foreach ($response["data"]["tournaments"] as $value) {

            $data=new roanuz_tournaments;
            $data->key=$value['key'];
            $data->name=$value['name'];
            $data->short_name=$value['short_name'];
            $data->start_date=$value['start_date']['gmt'];
            $data->end_date=$value['end_date']['gmt'];
            $data->competition_key=$value['competition']['key'];
            $data->save();
        }

        return response()->json(['success' =>"saved"],200);

    }



}
