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

Route::get('/', 'IndexController@index')->name('index');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('add-video', 'VideoController@add')->name('addVideo');
Route::post('add-video', 'VideoController@store')->name('videoStore');


Route::get('videos/{id}', 'VideoPageController@index')->name('videoPage');
Route::post('videos/{id}', 'VideoPageController@storeComment')->name('storeComment');

Route::post('home', 'HomeController@uploadAvatar');

Route::get('user/{id}', 'UserController@show')->name('UserPage');

Route::get('users', 'AllUsersController@show')->name('allUsers');

Route::get('r', 'IndexController@byRating')->name('sortByRating');

Route::get('deleteVideo', 'HomeController@deleteVideo');
Route::get('returnVideo', 'HomeController@returnVideo');



