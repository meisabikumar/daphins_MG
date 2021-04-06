<?php

namespace App\Models\ApiModel\football\unique_data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unique_teams extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'players' => 'array',
    ];
}
