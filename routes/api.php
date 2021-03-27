<?php
// http://127.0.0.1:8000/api/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\LoginController;

use App\Http\Controllers\ApiController\FixtureController;
use App\Http\Controllers\ApiController\MatchesController;
use App\Http\Controllers\ApiController\PlayerController;

// -- Football Data-
use App\Http\Controllers\ApiController\Football\Sportsmonk\Sportsmonk_Api_Controller;
use App\Http\Controllers\ApiController\Football\Roanuz\Roanuz_Api_Controller;
use App\Http\Controllers\ApiController\Football\Foolball_Filtering_Controller;
use App\Http\Controllers\ApiController\AppResController;
// ----

// --Cricket Data ---
use App\Http\Controllers\ApiController\Cricket\Cricket_Data_Controller;
use App\Http\Controllers\ApiController\Cricket\Cricket_AppResController;
// -----

// -- Admin Contest ---
use App\Http\Controllers\AdminController\Cricket\Cricket_Contest_Controller;
use App\Http\Controllers\AdminController\Football\Football_Contest_Controller;
// -------

// -- User ---
use App\Http\Controllers\User\User_Contest_Controller;
use App\Http\Controllers\User\Wallet_Transaction_Controller;
// -------

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


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

// --- Football API---

    // SportsMonk Data Feeding--------
    Route::get('/sportsmonk_fixture',[Sportsmonk_Api_Controller::class,'sportsmonk_get_fixtureByRange']);
    Route::get('/sportsmonk_fixture_teams',[Sportsmonk_Api_Controller::class,'sportsmonk_get_teamsByFixture']);
    Route::get('/sportsmonk_match',[Sportsmonk_Api_Controller::class,'make_fixture_data_similar_to_other_API']);
    // ---------------------------------------------------------------------------------------------

    // Roanuz Data Feeding-----
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
    Route::post('/football/get-teams-data',[AppResController::class,'football_get_team_by_match_id']);
    Route::post('/football/get-contest',[AppResController::class,'get_football_contest_response']);
    // -----------------------------------------------------------------------

// -----------------



// -------Cricket API------------
    Route::get('/cricket/fixtures',[Cricket_Data_Controller::class,'fixtures']);
    Route::get('/cricket/cricket_fixture_teams',[Cricket_Data_Controller::class,'cricket_fixture_teams']);
    // ---Criket App Response ---
    Route::get('/cricket/MatchData',[Cricket_AppResController::class,'MatchDataRes']);
    Route::post('/cricket/get-teams-data',[Cricket_AppResController::class,'cricket_get_team_by_match_id']);
    Route::post('/cricket/get-contest',[Cricket_AppResController::class,'get_cricket_contest_response']);
// -------------------------



// ------ Admin --------------------------------------------------------------------
    // Footaball-----------------------------------------------------------------
        // --- Create Contest --------------------------------------------------
        Route::post('/admin/football/create-contest',[Football_Contest_Controller::class,'store']);
        // ------------------------------------------------------------------------
    // ---------------------------------------------------------------------------

    // Cricket---------------------------------------------------------------------
        // -----Create contest-----------------------------------------------------
        Route::post('/admin/cricket/create-contest',[Cricket_Contest_Controller::class,'store']);
        // --------------------------------------------------------------------------
    // -------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

// ---- USER ---------------------------------------------------------------------------
Route::post('/join-contest',[User_Contest_Controller::class,'join_contest']);
Route::post('/wallet-Transaction',[Wallet_Transaction_Controller::class,'store']);
// -------------------------------------------------------------------------------------

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


