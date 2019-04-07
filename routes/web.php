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

Route::get('/completeregistration', 'Auth\CompleteRegistrationController@create');
Route::post('/completeregistration', 'Auth\CompleteRegistrationController@update');

Route::get('/threads/search', 'SearchController@show');

Route::get('api/courses', 'Api\CoursesController@getSubjects');

Route::post('/courses', 'CourseController@store')->middleware('admin')->name('courses.store');
Route::get('/dashboard/courses/create', 'CourseController@create')->middleware('admin')->name('courses.create');

Route::get('/courses', 'CourseController@index')->name('courses');
Route::get('/courses/{subject}', 'CourseController@index');
Route::get('/courses/{subject}/{course}', 'CourseController@show');

Route::post('/subjects', 'SubjectController@store')->middleware('admin')->name('subjects.new');

Route::get('api/difficulties', 'Api\DifficultyController@index');
Route::get('api/types', 'Api\TypeController@index'); // Course Type

Route::get('/threads/new', 'ThreadController@create');
Route::get('/threads', 'ThreadController@index')->name('threads');
Route::get('/threads/{channel}', 'ThreadController@index');
Route::post('/threads', 'ThreadController@store')->middleware('must-be-confirmed');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::patch('/threads/{channel}/{thread}', 'ThreadController@update')->name('threads.update');
Route::delete('threads/{channel}/{thread}', 'ThreadController@destroy');

Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionController@store')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionController@destroy')->middleware('auth');

Route::post('locked-threads/{thread}', 'lockedThreadController@store')->name('locked-threads.store')->middleware('admin');
Route::delete('locked-threads/{thread}', 'lockedThreadController@destroy')->name('locked-threads.destroy')->middleware('admin');

Route::patch('/replies/{reply}', 'ReplyController@update');
Route::delete('/replies/{reply}', 'ReplyController@destroy')->name('reply.destroy');
Route::get('/threads/{channel}/{thread}/replies', 'ReplyController@index');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');

Route::post('/replies/{reply}/best', 'BestReplyController@store')->name('best-replies.store');



Route::post('/replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/profiles/{user}', 'ProfileController@show')->name('profile.show');

Route::get('/profiles/{user}/notifications', 'UserNotificationController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationController@destroy');

Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.comfirm');
Route::get('/register/resend', 'Auth\RegisterConfirmationController@resend')->name('register.resend_comfirmation');
Route::get('/register/comfirm_email', 'Auth\RegisterConfirmationController@create')->middleware('cannot-see-resend-link-page')->name('register.confirm_email');

// Route::get('/register/confirm/register', 'Auth\RegisterConfirmationController@create')->name('register.recomfirm');

Route::get('/home/{user}/courses', 'HomeController@subscribedCourses');

Route::post('/follow', 'FollowersController@store');

Route::get('/courses/{subject}/{course}/medium', 'PaymentController@index');
Route::post('/pay/{course}', 'PaymentController@redirectToGateway')->name('pay'); 
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::get('/paid/{course}', 'PaymentController@paymentSuccessful');

Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->middleware('auth')->name('avatar');
