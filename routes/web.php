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

Route::get('/news', function () {
    return view('news');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/photos', function () {
    return view('photos');
});

Route::get('/live-cameras', function () {
    return view('live-cameras');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/single', function () {
    return view('single');
});
