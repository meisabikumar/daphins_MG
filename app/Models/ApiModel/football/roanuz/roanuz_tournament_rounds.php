<?php

namespace App\Models\ApiModel\football\roanuz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roanuz_tournament_rounds extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'groups' => 'array',
        'round_teams' => 'array',
        'tournament_teams' => 'array',
        'competition_data' => 'array',
    ];
}
