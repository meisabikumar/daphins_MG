<?php

namespace App\Models\ApiModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roanuz_tournament_rounds_list extends Model
{
    use HasFactory;

    protected $casts = [
        'teams' => 'array',
    ];
}
