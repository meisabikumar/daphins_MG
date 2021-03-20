<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\LoginController;

Route::get('refresh', function () {

    \Artisan::call('migrate:refresh');
    dd("Done");
});



