<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();


Route::get('/logout', 'HomeController@logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'participant'], 'prefix' => 'participant'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::prefix('absent')->group(function () {
        Route::get('/', 'ParticipantController@showAbsent');
        Route::post('/', 'ParticipantController@absent');
        Route::get('/detail', 'ParticipantController@showParticipantDetail');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductController@show');
        Route::post('/', 'ProductController@create');
        Route::put('/', 'ProductController@edit');
        Route::get('/edit', 'ProductController@showEdit');
        Route::get('/detail', 'ParticipantController@showParticipantDetail');
    });
    Route::prefix('report')->group(function () {
        Route::get('/', 'ReportController@index');
        Route::post('/', 'ReportController@store');
    });
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@show');
    Route::get('/total', 'AdminController@showAllAttend');

    Route::get('/map/{place}', 'AdminController@showMapWithSamePlace');
    Route::get('/detail/{month}/{year}/{nik}', 'AdminController@showAdminParticipantDetail');

    Route::prefix('setting')->group(function () {
        Route::get('/attend-time', 'AdminController@showAttendTimeSet');
        Route::post('/attend-time', 'AdminController@attendTimeSet');
        Route::get('/late-time', 'AdminController@showLateTimeSet');
        Route::post('/late-time', 'AdminController@lateTimeSet');
        Route::post('/uninvalid/{id}', 'AdminController@uninvalid');
        Route::post('/invalid/{id}', 'AdminController@invalid');
    });
});


Route::get('/tes', function () {
    return view('tes');
});
Route::post('/tes', 'ParticipantController@tes');
