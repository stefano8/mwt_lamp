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

//frontend

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

Route::get('/live-cameras','ItineraryController@getItineraries')->name('itinerary.list');

Route::get('/single/{itineraryId}','ItineraryController@singleItinerary')->name('itinerary.single');


//backend - admin

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//rotte per CRUD su itinerari
Route::get('admin/itinerary/index', 'ItineraryController@index')->name('itinerary');
Route::get('admin/itinerary/create', 'ItineraryController@create')->name('itinerary.create');
Route::get('admin/itinerary/save', 'ItineraryController@save')->name('itinerary.save');
Route::get('admin/itinerary/{id}/edit', 'ItineraryController@edit')->name('itinerary.edit');
Route::get('admin/itinerary/{id}/delete', 'ItineraryController@delete')->name('itinerary.delete');
Route::get('admin/itinerary/{id}/store', 'ItineraryController@store')->name('itinerary.store');

//rotte per CRUD su utenti
Route::get('admin/user/index', 'UserController@index')->name('user');
Route::get('admin/user/{id}/edit', 'UserController@edit')->name('user.edit');
Route::get('admin/user/{id}/delete', 'UserController@delete')->name('user.delete');
Route::get('admin/user/{id}/store', 'UserController@store')->name('user.store');
Route::get('admin/user/{user_id}/assign', 'UserController@showAssignment')->name('user.showAssignment');
Route::get('admin/user/{user_id}/{group_id}/saveAssign', 'UserController@saveAssignment')->name('user.saveAssignment');
//mio profilo backend
Route::get('admin/settings', 'UserController@settings')->name('user.settings');


//rotte per CRUD su gruppi
Route::get('admin/group/index', 'GroupController@index')->name('group');
Route::get('admin/group/create', 'GroupController@create')->name('group.create');
Route::get('admin/group/save', 'GroupController@save')->name('group.save');
Route::get('admin/group/{id}/edit', 'GroupController@edit')->name('group.edit');
Route::get('admin/group/{id}/delete', 'GroupController@delete')->name('group.delete');
Route::get('admin/group/{id}/store', 'GroupController@store')->name('group.store');

