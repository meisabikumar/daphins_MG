<?php

namespace App\Models\ApiModel\football\sportsmonk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sportsmonk_match_teams extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'players' => 'array',
    ];
}
