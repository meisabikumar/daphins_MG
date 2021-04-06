<?php

namespace App\Models\ApiModel\Cricket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cricket_fixture extends Model
{
    use HasFactory;


    protected $guarded = [];


    protected $casts = [
        'visitorteam_dl_data' => 'array',
        'localteam_dl_data' => 'array',
        'weather_report' => 'array',
        'localteam_data' => 'array',
        'visitorteam_data' => 'array',
    ];

}
