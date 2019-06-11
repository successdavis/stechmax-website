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
    $type = \App\Type::find(3);
    $programs = !empty($type) ? $type->courses()->get() : [];
    return view('welcome', compact('programs'));
});


Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/completeregistration', 'Auth\CompleteRegistrationController@create');
Route::post('/completeregistration', 'Auth\CompleteRegistrationController@update');

Route::get('/threads/search', 'SearchController@show');

Route::get('api/courses', 'Api\CoursesController@getSubjects');
Route::get('api/courses/allcourses', 'Api\CoursesController@getCourses');
Route::post('api/courses/{subject}/{course}', 'Api\CourseImageController@store')->middleware(['auth', 'admin']);

Route::get('api/courses/{course}/getcourses', 'TrackController@getTrackCourses')->middleware('admin')->name('courses.getCourses');
Route::post('tracks/{course}/addcourse', 'TrackController@store')->middleware('admin')->name('track.store');
Route::put('tracks/{course}/reOrderCourses', 'TrackController@reOrderCourses')->middleware('admin')->name('track.reOrder');
Route::delete('tracks/{course}/delete', 'TrackController@destroy')->middleware('admin')->name('track.destroy');

Route::post('courses/{course}/learn', 'LearnController@store')->middleware(['auth', 'admin'])->name('learn.store');
Route::get('courses/{course}/learn', 'LearnController@getLearns')->middleware(['admin']);
Route::put('courses/{course}/learn', 'LearnController@reOrderLearns')->middleware(['admin']);
Route::delete('courses/{learn}/learn', 'LearnController@destroy')->middleware(['admin']);
Route::patch('courses/{learn}/learn', 'LearnController@update')->middleware(['admin']);

Route::post('courses/{course}/requirement', 'RequirementController@store')->middleware(['auth', 'admin'])->name('requirement.store');
Route::get('courses/{course}/requirement', 'RequirementController@getRequirements')->middleware(['admin']);
Route::put('courses/{course}/requirement', 'RequirementController@reOrderRequirements')->middleware(['admin']);
Route::delete('courses/{requirement}/requirement', 'RequirementController@destroy')->middleware(['admin']);
Route::patch('courses/{requirement}/requirement', 'RequirementController@update')->middleware(['admin']);

Route::post('manage/{course}/section', 'SectionController@store')->middleware(['auth', 'admin'])->name('section.store');
Route::get('manage/{course}/sections', 'SectionController@index')->middleware(['auth', 'admin'])->name('section.index');
Route::put('manage/{course}/sections', 'SectionController@reOrderSections')->middleware(['admin']);
Route::patch('manage/{section}/section', 'SectionController@update')->middleware(['admin']);
Route::delete('manage/{section}/section', 'SectionController@destroy')->middleware(['admin']);

Route::post('manage/{section}/lecture', 'LectureController@store')->middleware(['auth', 'admin'])->name('lecture.store');
Route::get('manage/{section}/lectures', 'LectureController@index')->middleware(['admin'])->name('lecture.get');
Route::put('manage/{section}/lectures', 'LectureController@reOrderLectures')->middleware(['admin']);
Route::patch('manage/{lecture}/lecture', 'LectureController@update')->middleware(['admin']);
Route::delete('manage/{lecture}/lecture', 'LectureController@destroy')->middleware(['admin']);


Route::post('/courses', 'CourseController@store')->middleware('admin')->name('courses.store');
Route::patch('/courses/{course}', 'CourseController@update')->middleware('admin')->name('courses.update');
Route::get('/dashboard/courses/create', 'CourseController@create')->middleware('admin')->name('courses.create');
Route::get('/dashboard/{course}/manage', 'CourseController@edit')->middleware('admin')->name('courses.edit');
Route::get('/dashboard/{course}/publish', 'CourseController@publish')->middleware('admin')->name('courses.publish');
Route::get('/dashboard/{course}/unpublish', 'CourseController@unPublish')->middleware('admin')->name('courses.unPublish');

Route::get('/dashboard/users', 'ManageUserController@index')->middleware('admin')->name('manage_user.index');
Route::get('/dashboard/users/datatable', 'ManageUserController@getUsersForDataTable')->middleware('admin')->name('manage_user.datatables');

Route::patch('/users/{user}/update', 'ManageUserController@update')->middleware('admin');

Route::get('/courses', 'CourseController@index')->name('courses');
Route::get('/courses/{subject}', 'CourseController@index');
Route::get('/courses/{subject}/{course}', 'CourseController@show');

Route::get('/courses/{subject}/{course}/register', 'ProgramController@create');


Route::get('/courses/{subject}/{course}/subscription', 'Payment\CourseSubscriptionController@index')->name('course_subscription.index')->middleware('auth')->middleware('auth', 'must-be-confirmed');
Route::post('/courses/{subject}/{course}/subscription', 'Payment\CourseSubscriptionController@store')->name('course_subscription.store')->middleware('auth', 'must-be-confirmed');
//Route::get('/courses/{subject}/{course}/callback', 'Payment\CourseSubscriptionController@update')->name('course_subscription.update')->middleware('auth');


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
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store')->middleware('must-be-confirmed');

Route::post('/replies/{reply}/best', 'BestReplyController@store')->name('best-replies.store');



Route::post('/replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/profiles/{user}', 'ProfileController@show')->name('profile.show');

Route::get('/profiles/{user}/notifications', 'UserNotificationController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationController@destroy');

Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');
Route::get('/register/resend', 'Auth\RegisterConfirmationController@resend')->name('register.resend_comfirmation');
Route::get('/register/comfirm_email', 'Auth\RegisterConfirmationController@create')->middleware('cannot-see-resend-link-page')->name('register.confirm_email');

Route::post('/register/new_user', 'ManageUserController@store')->middleware('admin')->name('manage_user.store');

//Route::patch('/users/{user}', 'ManageUserController@store')->middleware('admin')->name('manage_user.store');

Route::post('/follow', 'FollowersController@store');


Route::get('/testing', 'TestingController@index'); // will be here temporary


//Route::post('/pay/{course}', 'PaymentController@redirectToGateway')->name('pay');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::get('/paid/{course}', 'PaymentController@paymentSuccessful');

Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->middleware('auth')->name('avatar');
