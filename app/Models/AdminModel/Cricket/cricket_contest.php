<?php

namespace App\Models\AdminModel\Cricket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cricket_contest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'breakdown' => 'array',
    ];
}

