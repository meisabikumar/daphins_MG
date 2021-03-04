<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiModel\FixtureModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class fixins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixture:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api_token="CcP4ZFsZBYTETwlUf96ICZwMccTk5NJVXlq2meeTzAI2gD3gOt89moKYy5uD";
        // Date Automatation
        $start_date=date("Y-m-d");
        $date=date_create($start_date);
        date_add($date,date_interval_create_from_date_string("5 days"));
        $end_date=date_format($date,"Y-m-d");
        // Http Clinet Response
        $url="https://soccer.sportmonks.com/api/v2.0/fixtures/between/".$start_date."/".$end_date;

        // Response
        $response = Http::withToken($api_token)->get($url);
        // Feeding Data in Database
        foreach ($response['data'] as $value) {
            // Model Obeject
            $FixtureModel=new FixtureModel();
            // Model Function Call
            $res=$FixtureModel->getFixtureModel($value); 
        }
        echo "Updated";
    }
}
