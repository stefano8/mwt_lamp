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


/*Route::get('/', 'UserController@showDash' , function () {
    return view('welcome');
});*/

/**
 * FRONT-END
 **/
Route::get('/', 'BaseController@index')->name('base');

Route::get('/advices', 'AdviceController@getAdvices')->name('adviceget');

Route::get('/news', function () {
    return view('news');
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/events', function () {
    return view('events');
});


//rota per ricerca
Route::get('/search','ItineraryController@search')->name('search');

//rotte per itinerari
Route::get('/itineraries/{itineraryId}','ItineraryController@getItineraries')->name('itinerary.list');
Route::get('/itineraries/{itineraryId}/add','ItineraryController@addToWishlist')->name('itinerary.addwishlist');
Route::get('/itineraries/{itineraryId}/remove','ItineraryController@removeToWishlist')->name('itinerary.removewishlist');

Route::get('/itineraries/{itineraryId}/seen','ItineraryController@addToCollection')->name('itinerary.addcollection');
Route::get('/itineraries/{itineraryId}/unseen','ItineraryController@removeToCollection')->name('itinerary.removecollection');

Route::get('/single/{itineraryId}','ItineraryController@singleItinerary')->name('itinerary.single');

//rotte per voti
Route::get('/single/{itineraryId}/{userId}/{value}','ItineraryController@addvote')->name('itinerary.addvote');

//rotta news
Route::get('/news','NewsController@getNews')->name('newsf');

//rotta per filro dicategorie su itinerari
Route::get('/itine/{categoryId}','ItineraryController@filterCategory')->name('filtercategory');

//profilo
Route::get('/profile','ItineraryController@showProfile')->name('profile');
Route::get('/itinerario/{nameItinerary}', 'ItineraryController@showSingleItinerary')->name('profile.collection');





/**
 * BECK-END - admin
 **/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rotte per CRUD su itinerari
Route::get('admin/itinerary/index', 'ItineraryController@index')->name('itinerary');
Route::get('admin/itinerary/create', 'ItineraryController@create')->name('itinerary.create');
Route::get('admin/itinerary/save', 'ItineraryController@save')->name('itinerary.save');
Route::get('admin/itinerary/{id}/edit', 'ItineraryController@edit')->name('itinerary.edit');
Route::get('admin/itinerary/{id}/delete', 'ItineraryController@delete')->name('itinerary.delete');
Route::get('admin/itinerary/{id}/store', 'ItineraryController@store')->name('itinerary.store');
Route::get('admin/itinerary/{itinerary_id}/assign', 'ItineraryController@showAssignment')->name('itinerary.showAssignment');
Route::get('admin/itinerary/{itinerary_id}/{category_id}/saveAssign', 'ItineraryController@saveAssignment')->name('itinerary.saveAssignment');
Route::get('admin/itinerary/{itinerary_id}/{category_id}/remove', 'ItineraryController@removeAssignment')->name('itinerary.remove');


//rotte per CRUD su utenti
Route::get('admin/user/index', 'UserController@index')->name('user');
Route::get('admin/user/{id}/edit', 'UserController@edit')->name('user.edit');
Route::get('admin/user/{id}/delete', 'UserController@delete')->name('user.delete');
Route::get('admin/user/{id}/store', 'UserController@store')->name('user.store');
Route::get('admin/user/{user_id}/assign', 'UserController@showAssignment')->name('user.showAssignment');
Route::get('admin/user/{user_id}/{group_id}/saveAssign', 'UserController@saveAssignment')->name('user.saveAssignment');
Route::get('admin/user/{user_id}/{group_id}/remove', 'UserController@removeAssignment')->name('user.remove');

//mio profilo backend
Route::get('admin/settings', 'UserController@settings')->name('user.settings');


//rotte per CRUD su gruppi
Route::get('admin/group/index', 'GroupController@index')->name('group');
Route::get('admin/group/create', 'GroupController@create')->name('group.create');
Route::get('admin/group/save', 'GroupController@save')->name('group.save');
Route::get('admin/group/{id}/edit', 'GroupController@edit')->name('group.edit');
Route::get('admin/group/{id}/delete', 'GroupController@delete')->name('group.delete');
Route::get('admin/group/{id}/store', 'GroupController@store')->name('group.store');


//rotte per CRUD su categorie
Route::get('admin/category/index', 'CategoryController@index')->name('category');
Route::get('admin/category/create', 'CategoryController@create')->name('category.create');
Route::get('admin/category/save', 'CategoryController@save')->name('category.save');
Route::get('admin/category/{id}/edit', 'CategoryController@edit')->name('category.edit');
Route::get('admin/category/{id}/delete', 'CategoryController@delete')->name('category.delete');
Route::get('admin/category/{id}/store', 'CategoryController@store')->name('category.store');


//rotte per CRUD su eventi
Route::get('admin/event/index', 'EventController@index')->name('event');
Route::get('admin/event/create', 'EventController@create')->name('event.create');
Route::get('admin/event/save', 'EventController@save')->name('event.save');
Route::get('admin/event/{id}/edit', 'EventController@edit')->name('event.edit');
Route::get('admin/event/{id}/delete', 'EventController@delete')->name('event.delete');
Route::get('admin/event/{id}/store', 'EventController@store')->name('event.store');


//rotte per CRUD su recensioni
Route::get('admin/review/index', 'ReviewController@index')->name('review');
Route::get('admin/review/{id}/approve', 'ReviewController@approve')->name('review.approve');
Route::get('admin/review/{id}/delete', 'ReviewController@delete')->name('review.delete');
//frontend
Route::get('single', 'ReviewController@showReview')->name('review.showreview');
Route::get('{itinerary_id}/single', 'ReviewController@insert')->name('review.insert');


//rotte per CRUD su news
Route::get('admin/news/index', 'NewsController@index')->name('news');
Route::get('admin/news/create', 'NewsController@create')->name('news.create');
Route::get('admin/news/save', 'NewsController@save')->name('news.save');
Route::get('admin/news/{id}/edit', 'NewsController@edit')->name('news.edit');
Route::get('admin/news/{id}/delete', 'NewsController@delete')->name('news.delete');
Route::get('admin/news/{id}/store', 'NewsController@store')->name('news.store');


//rotte per CRUD su consigli
Route::get('admin/advice/index', 'AdviceController@index')->name('advice');
Route::get('admin/advice/create', 'AdviceController@create')->name('advice.create');
Route::get('admin/advice/save', 'AdviceController@save')->name('advice.save');
Route::get('admin/advice/{id}/edit', 'AdviceController@edit')->name('advice.edit');
Route::get('admin/advice/{id}/delete', 'AdviceController@delete')->name('advice.delete');
Route::get('admin/advice/{id}/store', 'AdviceController@store')->name('advice.store');


//rotte per CRUD su città
Route::get('admin/city/index', 'CityController@index')->name('city');
Route::get('admin/city/create', 'CityController@create')->name('city.create');
Route::get('admin/city/save', 'CityController@save')->name('city.save');
Route::get('admin/city/{id}/edit', 'CityController@edit')->name('city.edit');
Route::get('admin/city/{id}/delete', 'CityController@delete')->name('city.delete');
Route::get('admin/city/{id}/store', 'CityController@store')->name('city.store');


//rotte per CRUD su regioni
Route::get('admin/region/index', 'RegionController@index')->name('region');


//rotte per CRUD su image
Route::get('admin/image/index', 'ImageController@index')->name('image');
Route::get('admin/image/create', 'ImageController@create')->name('image.create');
Route::get('admin/image/save', 'ImageController@save')->name('image.save');
Route::get('admin/image/{id}/edit', 'ImageController@edit')->name('image.edit');
Route::get('admin/image/{id}/delete', 'ImageController@delete')->name('image.delete');
Route::get('admin/image/{id}/store', 'ImageController@store')->name('image.store');


//rotte per assegnamento immagini a itinerari
Route::get('admin/image/assign/itinerary', 'ImageController@assignItinerary')->name('image.assignItinerary');
Route::get('admin/image/assign/{itinerary_id}/assignItinerary', 'ImageController@showAssignmentItinerary')->name('image.showAssignmentItinerary');
Route::get('admin/image/assign/{itinerary_id}/saveAssign', 'ImageController@saveAssignmentItinerary')->name('image.saveAssignmentItinerary');
Route::get('admin/image/assign/{itinerary_id}/{image_id}/remove', 'ImageController@removeAssignmentItinerary')->name('image.remove');

//rotte per assegnamento immagini a utenti
Route::get('admin/image/assign/user', 'ImageController@assignUser')->name('image.assignUser');
Route::get('admin/image/assign/{user_id}/assignUser', 'ImageController@showAssignmentUser')->name('image.showAssignmentUser');
Route::get('admin/image/assign/{user_id}/saveAssignUser', 'ImageController@saveAssignmentUser')->name('image.saveAssignmentUser');
Route::get('admin/image/assign/{user_id}/{image_id}/removeUser', 'ImageController@removeAssignmentUser')->name('image.removeUser');

//rotte per assegnamento immagini a eventi
Route::get('admin/image/assign/event', 'ImageController@assignEvent')->name('image.assignEvent');
Route::get('admin/image/assign/{event_id}/assignEvent', 'ImageController@showAssignmentEvent')->name('image.showAssignmentEvent');
Route::get('admin/image/assign/{event_id}/saveAssignEvent', 'ImageController@saveAssignmentEvent')->name('image.saveAssignmentEvent');
Route::get('admin/image/assign/{event_id}/{image_id}/removeEvent', 'ImageController@removeAssignmentEvent')->name('image.removeEvent');

//rotte per assegnamento immagini a news
Route::get('admin/image/assign/news', 'ImageController@assignNews')->name('image.assignNews');
Route::get('admin/image/assign/{news_id}/assignNews', 'ImageController@showAssignmentNews')->name('image.showAssignmentNews');
Route::get('admin/image/assign/{news_id}/saveAssignNews', 'ImageController@saveAssignmentNews')->name('image.saveAssignmentNews');
Route::get('admin/image/assign/{news_id}/{image_id}/removeNews', 'ImageController@removeAssignmentNews')->name('image.removeNews');


