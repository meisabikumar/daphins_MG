<?php

namespace App\Models\ApiModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roanuz_match_teams_list extends Model
{
    use HasFactory;

    protected $casts = [
        'players' => 'array',
    ];
}
