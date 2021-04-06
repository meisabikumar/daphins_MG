<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_contest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'players' => 'array',
    ];
}

