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

// ---
use App\Http\Controllers\ApiController\Football\Roanuz\Roanuz_Api_Controller;
use App\Http\Controllers\ApiController\Football\Foolball_Filtering_Controller;
// ----

// -----
use App\Http\Controllers\ApiController\Cricket\Cricket_Data_Controller;
use App\Http\Controllers\ApiController\Cricket\Cricket_AppResController;
// -----

// -----
use App\Http\Controllers\AdminController\Cricket\Cricket_Contest_Controller;
use App\Http\Controllers\AdminController\Football\Football_Contest_Controller;
// -------


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

Route::get('/sportsmonk_match_list',[MatchesController::class,'sportsmonk_match_list']);

// --- Football ---

    // Roanuz-----
    Route::get('/roanuz_Auth',[Roanuz_Api_Controller::class,'roanuz_Auth']);
    Route::get('/roanuz_recent_tournament',[Roanuz_Api_Controller::class,'roanuz_recent_tournament']);
    Route::get('/roanuz_tournament_rounds',[Roanuz_Api_Controller::class,'roanuz_tournament_rounds']);
    Route::get('/roanuz_matchs',[Roanuz_Api_Controller::class,'roanuz_matchs']);
    Route::get('/roanuz_match_teams',[Roanuz_Api_Controller::class,'roanuz_match_teams']);
    // -------------------------------------------------------------------------------

    // Filteing ---
    Route::get('/filter_unique_match',[Foolball_Filtering_Controller::class,'filter_unique_match']);
    Route::get('/filter_unique_team',[Foolball_Filtering_Controller::class,'filter_unique_team']);
    // -------------------------------------------------------------------------------------------

    // Football App response
    Route::get('/MatchData',[AppResController::class,'MatchDataRes']);
    Route::get('/TeamData',[AppResController::class,'TeamDataRes']);
    Route::get('/football/get-contest',[AppResController::class,'football_contest_response']);
    // -----------------------------------------------------------------------

// -----------------



// -------Cricket------------
Route::get('/cricket/fixtures',[Cricket_Data_Controller::class,'fixtures']);
Route::get('/cricket/all_teams',[Cricket_Data_Controller::class,'all_teams']);
// ---Criket App Response ---
Route::get('/cricket/MatchData',[Cricket_AppResController::class,'MatchDataRes']);
Route::get('/cricket/get-contest',[Cricket_AppResController::class,'cricket_contest_response']);
// -------------------------



// ------ Admin --------------------------------------------------------------------
    // Footaball-----------------------------------------------------------------
        // --- Create Contest --------------------------------------------------
        Route::get('/admin/football/create-contest',[Football_Contest_Controller::class,'store']);
        // ------------------------------------------------------------------------
    // ---------------------------------------------------------------------------

    // Cricket---------------------------------------------------------------------
        // -----create contest-----------------------------------------------------
        Route::get('/admin/cricket/create-contest',[Cricket_Contest_Controller::class,'store']);
        // --------------------------------------------------------------------------
    // -------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

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


