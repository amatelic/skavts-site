<?php
use App\Notification;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('/', 'NotificationController@showNotification');
Route::get('/notification', 'NotificationController@calenderNotification');
Route::get('/articles', 'ArticleController@showArticle');
Route::get('/articles/{year}', 'ArticleController@showArticleByYear')->where('year', '[0-9]+');
Route::get('/steg', function(){
  return view('main.steg');
});

Route::get('/gallery', 'ImageController@showGallerys');
Route::get('/getImages/{id}', 'ImageController@selectGalleryByYears')->where('id', '[0-9]+');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('/', 'AdminController');
    Route::get('/users/filter', 'UserController@filterUsers');
    Route::resource('/users', 'UserController');
    Route::resource('/images', 'ImageController');
    Route::get('/images/year/{year}', 'ImageController@dataByYear');
    Route::resource('/notifications', 'NotificationController');
    Route::get('/articlePagination/{id}', 'ArticleController@pagination');
    Route::resource('/articles', 'ArticleController');

});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('admin/auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
