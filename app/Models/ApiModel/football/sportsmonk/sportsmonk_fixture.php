<?php

namespace App\Models\ApiModel\football\sportsmonk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sportsmonk_fixture extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'weather_report' => 'array',
        'formations' => 'array',
        'scores' => 'array',
        'coaches' => 'array',
        'standings' => 'array',
        'assistants' => 'array',
        'colors' => 'array',
        'localteam_data' => 'array',
        'visitorteam_data' => 'array',
    ];
}
