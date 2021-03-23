<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\LoginController;

Route::get('migrate-refresh', function () {
    \Artisan::call('migrate:refresh');
    dd("Done");
});

Route::get('migrate', function () {
    \Artisan::call('migrate:refresh');
    dd("Done");
});


Route::get('clear', function () {

    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:cache');
    // \Artisan::call('cache:clear');
    dd("Done");
});

