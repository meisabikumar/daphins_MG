<?php

namespace App\Models\ApiModel\football\roanuz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roanuz_match_teams extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'players' => 'array',
    ];
}
