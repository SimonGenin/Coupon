<?php

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
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/test", function () {



});

Route::get('/announcement/create', function () {

    return view('announcement.create');

});

Route::post('/announcement', 'AnnouncementController@store')->name('announcement.store');

Route::get('/map', function () {

    return view('map');

});



