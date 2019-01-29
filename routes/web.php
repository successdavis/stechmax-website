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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/courses', 'CourseController@index');
Route::get('/courses/{subject}', 'CourseController@index');
Route::get('/courses/{subject}/{course}', 'CourseController@show');

Route::get('/threads/new', 'ThreadController@create');
Route::get('/threads', 'ThreadController@index');
Route::get('/threads/{channel}', 'ThreadController@index');
Route::post('/threads', 'ThreadController@store');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::delete('threads/{channel}/{thread}', 'ThreadController@destroy');

Route::patch('/replies/{reply}', 'ReplyController@update');
Route::delete('/replies/{reply}', 'ReplyController@destroy');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');

Route::post('/replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/profiles/{user}', 'ProfileController@show');
Route::get('/profiles/{user}/courses', 'SubscriptionController@index');
Route::get('/profiles/{user}/payments', 'ProfileController@getInvoices');

Route::post('/follow', 'FollowersController@store');

 
Route::get('/courses/{subject}/{course}/medium', 'PaymentController@index');

Route::post('/pay/{course}', 'PaymentController@redirectToGateway')->name('pay'); 
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
// Route::post('/webhook', 'WebhookController@handle');
