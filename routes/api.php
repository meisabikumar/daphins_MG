<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\LoginController;
use App\Http\Controllers\ApiController\ProfileController;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/hi', [LoginController::class, 'hi']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/signup', [LoginController::class, 'signup']);
    Route::post('/sendOtp', [LoginController::class, 'sendOtp']);

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', [LoginController::class, 'logout']);
        Route::get('user', [LoginController::class, 'user']);
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::Post('profile-update', [ProfileController::class, 'update']);
});
