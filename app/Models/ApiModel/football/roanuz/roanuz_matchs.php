<?php

namespace App\Models\ApiModel\football\roanuz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roanuz_matchs extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'groups' => 'array',
        'stadium' => 'array',
        'round_teams' => 'array',
    ];
}
