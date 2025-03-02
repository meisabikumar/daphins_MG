<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ApiController\LoginController;
use App\Http\Controllers\AdminController\HomeController;
use App\Http\Controllers\AdminController\loginController;

// -- Admin Contest ---
use App\Http\Controllers\AdminController\Cricket\Cricket_Contest_Controller;
use App\Http\Controllers\AdminController\Football\Football_Contest_Controller;
// -------
use App\Http\Controllers\AdminController\Cricket\Admin_Cricket_web_Controller;
use App\Http\Controllers\AdminController\Football\Admin_Football_web_Controller;
use App\Http\Controllers\Cric_Score_Controller;
use App\Http\Controllers\FootballController;

Route::get('migrate-refresh', function () {
    \Artisan::call('migrate:refresh');
    dd("Done");
});

Route::get('migrate', function () {
    \Artisan::call('migrate:refresh');
    dd("Done");
});
Route::get('/downlaodapk', function () {
    $file= public_path()."/mg_v1.8_nrml.apk";
    $headers = array(
          'Content-Type:application/apk',
        );
    // return Response::download($file, 'mg_v1.8_nrml.apk');
    return response()->download($file, 'mg_v1.8_nrml.apk', $headers);

});

Route::get('/Downloadapk',[HomeController::class,'downloadapp']);


// Route::get('passport', function () {
//     \Artisan::call('passport:install');
//     dd("Done");
// });
// Admin Login
Route::get('/admin',[loginController::class,'admin_login']);
// Admin Login Check
Route::any('/login_admin',[loginController::class,'login_admin']);
// Admin Logout
Route::get('/admin/logout_admin',[loginController::class,'logout_admin']);
// Middleware starts

Route::group(['middleware'=>['adminprotectedPage']],function()
{
// Dashboard views
Route::get('/admin/dashboard',[HomeController::class,'dashboard']);
// App User view
Route::get('/admin/App_Users',[HomeController::class,'app_users']);
// Football Part
// Routes by Amir
Route::get('/admin/Cric-Create',[Cricket_Contest_Controller::class,'cric_create']);
// Routes by Amir Ends
Route::get('/admin/football/contest',[Football_Contest_Controller::class,'index']);
Route::get('/admin/football/all_matchs',[Admin_Football_web_Controller::class,'all_matchs']);
Route::post('/admin/football/update_active_match',[Admin_Football_web_Controller::class,'update_active']);
Route::post('/admin/football/update_disable_match',[Admin_Football_web_Controller::class,'update_inactive']);
Route::get('/admin/football/get_player/{match_id}',[Admin_Football_web_Controller::class,'get_player']);
Route::post('/admin/football/get_player/{match_id}',[Admin_Football_web_Controller::class,'assign_player_credit']);
//Routes by Vansh
//users
Route::get('admin/users/view-user/{id}',[HomeController::class, 'view_user']);
Route::get('admin/users/delete-user/{id}',[HomeController::class, 'delete']);
//Football
Route::get('/admin/football/contest/create',[FootballController::class, 'create']);
Route::post('/admin/football/contest/create',[FootballController::class, 'add']);
Route::get('/admin/football/contest/edit/{id}',[FootballController::class, 'editContestCategory']);
Route::post('/admin/football/contest/edit/{id}',[FootballController::class, 'postUpdate']);
Route::get('/admin/football/contest/delete/{id}',[FootballController::class, 'delete']);
Route::get('/admin/football/contest/cancel/{id}',[FootballController::class, 'cancel']);
Route::get('/admin/football/contest/view/{id}',[FootballController::class, 'view']);
//Cricket
Route::get('/admin/cricket/contest/delete/{id}',[Cricket_Contest_Controller::class, 'delete']);
Route::get('/admin/cricket/contest/cancel/{id}',[Cricket_Contest_Controller::class, 'cancel']);
Route::get('/admin/cricket/contest/edit/{id}',[Cricket_Contest_Controller::class, 'editContestCategory']);
Route::post('/admin/cricket/contest/edit/{id}',[Cricket_Contest_Controller::class, 'postUpdate']);
Route::get('/admin/cricket/contest/view/{id}',[Cricket_Contest_Controller::class, 'view']);
Route::get('/admin/cric-players', function () {
    return view('AdminView.cricket.cric_players');
});
Route::get('/admin/foot-players', function () {
    return view('AdminView.cricket.cric_players');
});
//Routes by Vansh ends
// Cricket part
// Routes by Amir

// Routes by Amir Ends
Route::get('/admin/cricket/contest',[Cricket_Contest_Controller::class,'index']);
Route::get('/admin/cricket/all_matchs',[Admin_Cricket_web_Controller::class,'all_matchs']);
Route::post('/admin/cricket/update_active_match',[Admin_Cricket_web_Controller::class,'update_active']);
Route::post('/admin/cricket/update_disable_match',[Admin_Cricket_web_Controller::class,'update_inactive']);
Route::get('/admin/cricket/get_player/{match_id}',[Admin_Cricket_web_Controller::class,'get_player']);
Route::post('/admin/cricket/get_player/{match_id}',[Admin_Cricket_web_Controller::class,'assign_player_credit']);
// Code By Amita
Route::post('/admin/contests/cric_create/add',[Cricket_Contest_Controller::class,'store']);

// middleware ends


});
Route::get('clear', function () {

    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:cache');
    // \Artisan::call('cache:clear');
    dd("Done");
});


