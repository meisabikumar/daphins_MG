<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\LoginController;
use App\Http\Controllers\ApiController\ProfileController;
use App\Http\Controllers\ApiController\FixtureController;
use App\Http\Controllers\ApiController\MatchesController;
use App\Http\Controllers\ApiController\PlayerController;
use App\Http\Controllers\ApiController\RoanuzApiController;
use App\Http\Controllers\ApiController\AppResController;
use App\Http\Controllers\ApiController\filteringController;



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/hi', [LoginController::class, 'hi']);

// ---------- Routes by Abhishek ---------------

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

Route::get('/roanuzAuth',[RoanuzApiController::class,'roanuzAuth']);
Route::get('/recent_tournaments',[RoanuzApiController::class,'recent_tournaments']);
// Route::get('/tournament_teams_details',[RoanuzApiController::class,'tournament_teams_details']);
Route::get('/tournament_rounds_list',[RoanuzApiController::class,'tournament_rounds_list']);
Route::get('/match_list',[RoanuzApiController::class,'match_list']);
Route::get('/match_teams_list',[RoanuzApiController::class,'match_teams_list']);

Route::get('/sportsmonk_match_list',[MatchesController::class,'sportsmonk_match_list']);


// Route::get('/team_players_details',[RoanuzApiController::class,'team_players_details']);
// -----------------
Route::get('/filter_match',[filteringController::class,'filter_match']);
Route::get('/filter_team',[filteringController::class,'filter_team']);

Route::get('/MatchData',[AppResController::class,'MatchDataRes']);
Route::get('/TeamData',[AppResController::class,'TeamDataRes']);

// -----------------------------------------

// Routes By Aamir
Route::get('/GetFixture',[FixtureController::class,'getFixtureByRange']);
Route::get('/Team',[MatchesController::class,'getTeamone']);
Route::get('/Player',[PlayerController::class,'getPlayer']);
Route::get('/Testingstr',[MatchesController::class,'TestAlgo']);

// App Response Json
Route::get('/FixtureData',[AppResController::class,'FixtureRes']);
// Route::get('/TeamData',[AppResController::class,'TeamRes']);
Route::get('/PlayerData',[AppResController::class,'PlayerRes']);
// Ends
// ENds


