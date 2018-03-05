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

Route::get('/single', function () {
    return view('single');
});


//admin

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rotte per CRUD su itinerari
Route::get('admin/itinerary/index', 'ItineraryController@index')->name('itinerary');
Route::get('admin/itinerary/create', 'ItineraryController@create')->name('itinerary.create');
Route::get('admin/itinerary/save', 'ItineraryController@save')->name('itinerary.save');
Route::get('admin/itinerary/{id}/edit', 'ItineraryController@edit')->name('itinerary.edit');
Route::get('admin/itinerary/{id}/delete', 'ItineraryController@delete')->name('itinerary.delete');
Route::get('admin/itinerary/{id}/store', 'ItineraryController@store')->name('itinerary.store');



