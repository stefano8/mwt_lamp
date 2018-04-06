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

/**
 * FRONT-END
 **/

Route::get('/', 'BaseController@index')->name('base');

Route::get('/advices', 'AdviceController@getAdvices')->name('adviceget');
Route::get('/advices/single/{adviceId}', 'AdviceController@singleAdvice')->name('advice.single');


Route::get('/events', 'EventController@getEvent')->name('eventget');
Route::get('/events/single/{eventId}','EventController@singleEvent')->name('event.single');



Route::get('/news', function () {
    return view('news');
});
Route::get('/news/single/{newsId}', 'NewsController@singleNews')->name('news.single');


//rota per ricerca
Route::get('/search','ItineraryController@search')->name('search');

//rotte per itinerari
Route::get('/itineraries','ItineraryController@getItineraries')->name('itinerary.list');
Route::get('/itineraries/{itineraryId}/add','ItineraryController@addToWishlist')->name('itinerary.addwishlist')->middleware('auth');
Route::get('/itineraries/{itineraryId}/remove','ItineraryController@removeToWishlist')->name('itinerary.removewishlist')->middleware('auth');
Route::get('/itineraries/{itineraryId}/seen','ItineraryController@addToCollection')->name('itinerary.addcollection')->middleware('auth');
Route::get('/itineraries/{itineraryId}/unseen','ItineraryController@removeToCollection')->name('itinerary.removecollection')->middleware('auth');
Route::get('/single/{itineraryId}','ItineraryController@singleItinerary')->name('itinerary.single');

//rotte per voti
Route::get('/single/{itineraryId}/{userId}/{value}','ItineraryController@addvote')->name('itinerary.addvote');

//rotta news
Route::get('/news','NewsController@getNews')->name('newsf');

//rotta per filro dicategorie su itinerari
Route::get('/itine/{categoryId}','ItineraryController@filterCategory')->name('filtercategory');

//profilo
Route::get('/profile','ItineraryController@showProfile')->name('profile')->middleware('auth');
Route::get('/itinerario/{nameItinerary}', 'ItineraryController@showSingleItinerary')->name('profile.collection')->middleware('auth');


//recensioni
Route::get('single', 'ReviewController@showReview')->name('review.showreview');
Route::get('{itinerary_id}/single', 'ReviewController@insert')->name('review.insert');




/**
 * BECK-END - admin
 **/

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

//rotte per CRUD su itinerari
Route::get('admin/itinerary/index', 'ItineraryController@index')->name('itinerary')->middleware('auth');
Route::get('admin/itinerary/create', 'ItineraryController@create')->name('itinerary.create')->middleware('auth');
Route::get('admin/itinerary/save', 'ItineraryController@save')->name('itinerary.save')->middleware('auth');
Route::get('admin/itinerary/{id}/edit', 'ItineraryController@edit')->name('itinerary.edit')->middleware('auth');
Route::get('admin/itinerary/{id}/delete', 'ItineraryController@delete')->name('itinerary.delete')->middleware('auth');
Route::get('admin/itinerary/{id}/store', 'ItineraryController@store')->name('itinerary.store')->middleware('auth');
Route::get('admin/itinerary/{itinerary_id}/assign', 'ItineraryController@showAssignment')->name('itinerary.showAssignment')->middleware('auth');
Route::get('admin/itinerary/{itinerary_id}/{category_id}/saveAssign', 'ItineraryController@saveAssignment')->name('itinerary.saveAssignment')->middleware('auth');
Route::get('admin/itinerary/{itinerary_id}/{category_id}/remove', 'ItineraryController@removeAssignment')->name('itinerary.remove')->middleware('auth');


//rotte per CRUD su utenti
Route::get('admin/user/index', 'UserController@index')->name('user')->middleware('auth');
Route::get('admin/user/{id}/edit', 'UserController@edit')->name('user.edit')->middleware('auth');
Route::get('admin/user/{id}/delete', 'UserController@delete')->name('user.delete')->middleware('auth');
Route::get('admin/user/{id}/store', 'UserController@store')->name('user.store')->middleware('auth');
Route::get('admin/user/{user_id}/assign', 'UserController@showAssignment')->name('user.showAssignment')->middleware('auth');
Route::get('admin/user/{user_id}/{group_id}/saveAssign', 'UserController@saveAssignment')->name('user.saveAssignment')->middleware('auth');
Route::get('admin/user/{user_id}/{group_id}/remove', 'UserController@removeAssignment')->name('user.remove')->middleware('auth');

//mio profilo backend
Route::get('admin/settings', 'UserController@settings')->name('user.settings')->middleware('auth');


//rotte per CRUD su gruppi
Route::get('admin/group/index', 'GroupController@index')->name('group')->middleware('auth');
Route::get('admin/group/create', 'GroupController@create')->name('group.create')->middleware('auth');
Route::get('admin/group/save', 'GroupController@save')->name('group.save')->middleware('auth');
Route::get('admin/group/{id}/edit', 'GroupController@edit')->name('group.edit')->middleware('auth');
Route::get('admin/group/{id}/delete', 'GroupController@delete')->name('group.delete')->middleware('auth');
Route::get('admin/group/{id}/store', 'GroupController@store')->name('group.store')->middleware('auth');


//rotte per CRUD su categorie
Route::get('admin/category/index', 'CategoryController@index')->name('category')->middleware('auth');
Route::get('admin/category/create', 'CategoryController@create')->name('category.create')->middleware('auth');
Route::get('admin/category/save', 'CategoryController@save')->name('category.save')->middleware('auth');
Route::get('admin/category/{id}/edit', 'CategoryController@edit')->name('category.edit')->middleware('auth');
Route::get('admin/category/{id}/delete', 'CategoryController@delete')->name('category.delete')->middleware('auth');
Route::get('admin/category/{id}/store', 'CategoryController@store')->name('category.store')->middleware('auth');


//rotte per CRUD su eventi
Route::get('admin/event/index', 'EventController@index')->name('event')->middleware('auth');
Route::get('admin/event/create', 'EventController@create')->name('event.create')->middleware('auth');
Route::get('admin/event/save', 'EventController@save')->name('event.save')->middleware('auth');
Route::get('admin/event/{id}/edit', 'EventController@edit')->name('event.edit')->middleware('auth');
Route::get('admin/event/{id}/delete', 'EventController@delete')->name('event.delete')->middleware('auth');
Route::get('admin/event/{id}/store', 'EventController@store')->name('event.store')->middleware('auth');


//rotte per CRUD su recensioni
Route::get('admin/review/index', 'ReviewController@index')->name('review')->middleware('auth');
Route::get('admin/review/{id}/approve', 'ReviewController@approve')->name('review.approve')->middleware('auth');
Route::get('admin/review/{id}/delete', 'ReviewController@delete')->name('review.delete')->middleware('auth');


//rotte per CRUD su news
Route::get('admin/news/index', 'NewsController@index')->name('news')->middleware('auth');
Route::get('admin/news/create', 'NewsController@create')->name('news.create')->middleware('auth');
Route::get('admin/news/save', 'NewsController@save')->name('news.save')->middleware('auth');
Route::get('admin/news/{id}/edit', 'NewsController@edit')->name('news.edit')->middleware('auth');
Route::get('admin/news/{id}/delete', 'NewsController@delete')->name('news.delete')->middleware('auth');
Route::get('admin/news/{id}/store', 'NewsController@store')->name('news.store')->middleware('auth');


//rotte per CRUD su consigli
Route::get('admin/advice/index', 'AdviceController@index')->name('advice')->middleware('auth');
Route::get('admin/advice/create', 'AdviceController@create')->name('advice.create')->middleware('auth');
Route::get('admin/advice/save', 'AdviceController@save')->name('advice.save')->middleware('auth');
Route::get('admin/advice/{id}/edit', 'AdviceController@edit')->name('advice.edit')->middleware('auth');
Route::get('admin/advice/{id}/delete', 'AdviceController@delete')->name('advice.delete')->middleware('auth');
Route::get('admin/advice/{id}/store', 'AdviceController@store')->name('advice.store')->middleware('auth');


//rotte per CRUD su città
Route::get('admin/city/index', 'CityController@index')->name('city')->middleware('auth');
Route::get('admin/city/create', 'CityController@create')->name('city.create')->middleware('auth');
Route::get('admin/city/save', 'CityController@save')->name('city.save')->middleware('auth');
Route::get('admin/city/{id}/edit', 'CityController@edit')->name('city.edit')->middleware('auth');
Route::get('admin/city/{id}/delete', 'CityController@delete')->name('city.delete')->middleware('auth');
Route::get('admin/city/{id}/store', 'CityController@store')->name('city.store')->middleware('auth');


//rotte per CRUD su regioni
Route::get('admin/region/index', 'RegionController@index')->name('region')->middleware('auth');


//rotte per CRUD su image
Route::get('admin/image/index', 'ImageController@index')->name('image')->middleware('auth');
Route::get('admin/image/create', 'ImageController@create')->name('image.create')->middleware('auth');
Route::get('admin/image/save', 'ImageController@save')->name('image.save')->middleware('auth');
Route::get('admin/image/{id}/edit', 'ImageController@edit')->name('image.edit')->middleware('auth');
Route::get('admin/image/{id}/delete', 'ImageController@delete')->name('image.delete')->middleware('auth');
Route::get('admin/image/{id}/store', 'ImageController@store')->name('image.store')->middleware('auth');


//rotte per assegnamento immagini a itinerari
Route::get('admin/image/assign/itinerary', 'ImageController@assignItinerary')->name('image.assignItinerary')->middleware('auth');
Route::get('admin/image/assign/{itinerary_id}/assignItinerary', 'ImageController@showAssignmentItinerary')->name('image.showAssignmentItinerary')->middleware('auth');
Route::get('admin/image/assign/{itinerary_id}/saveAssign', 'ImageController@saveAssignmentItinerary')->name('image.saveAssignmentItinerary')->middleware('auth');
Route::get('admin/image/assign/{itinerary_id}/{image_id}/remove', 'ImageController@removeAssignmentItinerary')->name('image.remove')->middleware('auth');

//rotte per assegnamento immagini a utenti
Route::get('admin/image/assign/user', 'ImageController@assignUser')->name('image.assignUser')->middleware('auth');
Route::get('admin/image/assign/{user_id}/assignUser', 'ImageController@showAssignmentUser')->name('image.showAssignmentUser')->middleware('auth');
Route::get('admin/image/assign/{user_id}/saveAssignUser', 'ImageController@saveAssignmentUser')->name('image.saveAssignmentUser')->middleware('auth');
Route::get('admin/image/assign/{user_id}/{image_id}/removeUser', 'ImageController@removeAssignmentUser')->name('image.removeUser')->middleware('auth');

//rotte per assegnamento immagini a eventi
Route::get('admin/image/assign/event', 'ImageController@assignEvent')->name('image.assignEvent')->middleware('auth');
Route::get('admin/image/assign/{event_id}/assignEvent', 'ImageController@showAssignmentEvent')->name('image.showAssignmentEvent')->middleware('auth');
Route::get('admin/image/assign/{event_id}/saveAssignEvent', 'ImageController@saveAssignmentEvent')->name('image.saveAssignmentEvent')->middleware('auth');
Route::get('admin/image/assign/{event_id}/{image_id}/removeEvent', 'ImageController@removeAssignmentEvent')->name('image.removeEvent')->middleware('auth');

//rotte per assegnamento immagini a news
Route::get('admin/image/assign/news', 'ImageController@assignNews')->name('image.assignNews')->middleware('auth');
Route::get('admin/image/assign/{news_id}/assignNews', 'ImageController@showAssignmentNews')->name('image.showAssignmentNews')->middleware('auth');
Route::get('admin/image/assign/{news_id}/saveAssignNews', 'ImageController@saveAssignmentNews')->name('image.saveAssignmentNews')->middleware('auth');
Route::get('admin/image/assign/{news_id}/{image_id}/removeNews', 'ImageController@removeAssignmentNews')->name('image.removeNews')->middleware('auth');



//upload image
Route::get('image-upload','ImageController@imageUpload');
Route::post('image-upload/{id_user}','ImageController@imageUploadPost');


//mappa
