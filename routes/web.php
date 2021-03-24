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

// Route::get('/', function () {
//     return redirect('/login');
// });


Route::get('/', 'PublicController@index2');

Auth::routes();


Route::get('/logout', 'HomeController@logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/view_product', 'PublicController@index');
Route::get('/view_product/category/{category}', 'PublicController@index_category');
Route::get('/view_product/location/{location}', 'PublicController@index_location');
Route::get('/view_product/{id}', 'PublicController@show');
Route::get('/external_url/{url}', 'PublicController@external_url');

Route::group(['middleware' => ['auth', 'participant'], 'prefix' => 'participant'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::prefix('absent')->group(function () {
        Route::get('/', 'ParticipantController@showAbsent');
        Route::post('/', 'ParticipantController@absent');
        Route::get('/detail', 'ParticipantController@showParticipantDetail');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductController@show');
        Route::get('/upload', 'ProductController@showUpload');
        Route::post('/upload', 'ProductController@create');
        Route::get('/{id}', 'ProductController@showDetail');
        Route::put('/{id}', 'ProductController@edit');
        Route::get('/{id}/edit', 'ProductController@showEdit');
        Route::get('/detail', 'ParticipantController@showParticipantDetail');
    });
    Route::prefix('report')->group(function () {
        Route::get('/', 'ReportController@index');
        Route::post('/', 'ReportController@store');
    });
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/daily', 'AdminController@show');
    Route::get('/total', 'AdminController@showAllAttend');
    Route::get('/total/export', 'AdminController@exportExcel');


    Route::get('/', 'AdminController@showList');
    Route::get('/product', 'AdminController@showProduct');
    Route::get('/product/{nik}', 'AdminController@showProductDetail');
    Route::delete('/product/{nik}/{id}', 'AdminController@productDelete');
    Route::get('/report', 'AdminController@showReport');
    Route::get('/report/{nik}', 'AdminController@showReportDetail');
    Route::put('/report/{nik}', 'AdminController@reportDownloadAllOnePerson');
    Route::put('/report', 'AdminController@reportDownloadAll');
    Route::patch('/report/{nik}/{id}', 'AdminController@reportDownload');
    Route::delete('/report/{nik}/{id}', 'AdminController@reportDelete');


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
