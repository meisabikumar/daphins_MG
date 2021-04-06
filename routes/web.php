<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController\LoginController;
use App\Http\Controllers\AdminController\HomeController;

// -- Admin Contest ---
use App\Http\Controllers\AdminController\Cricket\Cricket_Contest_Controller;
use App\Http\Controllers\AdminController\Football\Football_Contest_Controller;
// -------
use App\Http\Controllers\AdminController\Cricket\Admin_Cricket_web_Controller;
use App\Http\Controllers\AdminController\Football\Admin_Football_web_Controller;


Route::get('migrate-refresh', function () {
    \Artisan::call('migrate:refresh');
    dd("Done");
});

Route::get('migrate', function () {
    \Artisan::call('migrate:refresh');
    dd("Done");
});

// Route::get('passport', function () {
//     \Artisan::call('passport:install');
//     dd("Done");
// });

Route::get('/admin/dashboard',[HomeController::class,'dashboard']);

Route::get('/admin/football/contest',[Football_Contest_Controller::class,'index']);
Route::get('/admin/football/all_matchs',[Admin_Football_web_Controller::class,'all_matchs']);
Route::post('/admin/football/update_active_match',[Admin_Football_web_Controller::class,'update_active']);
Route::post('/admin/football/update_disable_match',[Admin_Football_web_Controller::class,'update_inactive']);
Route::get('/admin/football/get_player/{match_id}',[Admin_Football_web_Controller::class,'get_player']);
Route::post('/admin/football/get_player/{match_id}',[Admin_Football_web_Controller::class,'assign_player_credit']);



Route::get('/admin/cricket/contest',[Cricket_Contest_Controller::class,'index']);
Route::get('/admin/cricket/all_matchs',[Admin_Cricket_web_Controller::class,'all_matchs']);
Route::post('/admin/cricket/update_active_match',[Admin_Cricket_web_Controller::class,'update_active']);
Route::post('/admin/cricket/update_disable_match',[Admin_Cricket_web_Controller::class,'update_inactive']);
Route::get('/admin/cricket/get_player/{match_id}',[Admin_Cricket_web_Controller::class,'get_player']);
Route::post('/admin/cricket/get_player/{match_id}',[Admin_Cricket_web_Controller::class,'assign_player_credit']);


Route::get('clear', function () {

    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:cache');
    // \Artisan::call('cache:clear');
    dd("Done");
});

