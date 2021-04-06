<?php

namespace App\Models\ApiModel\Cricket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cricket_fixture_teams extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'players' => 'array',
    ];
}
