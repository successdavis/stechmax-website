<?php

Route::get('/', 'HomepageController@index')->name('homepage.index');


Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/completeregistration', 'Auth\CompleteRegistrationController@create');
Route::post('/completeregistration', 'Auth\CompleteRegistrationController@update');

Route::get('/threads/search', 'SearchController@show');

Route::get('api/subjects', 'SubjectController@getSubjects');
Route::get('/api/subjectcourses', 'Api\CoursesController@getSubjectCourses');

Route::get('api/courses/allcourses', 'Api\CoursesController@getCourses');
Route::get('api/courses/allcoursesandtracks', 'Api\CoursesController@allcoursesandtracks')->middleware('admin');
Route::get('api/courses/viewAllCourses', 'Api\CoursesController@index')->middleware(['admin'])->name('courses.index');
Route::post('api/courses/{subject}/{course}', 'Api\CourseImageController@store')->middleware(['auth', 'admin']);


Route::post('api/{lecture}/video', 'LectureVideoController@store')->middleware(['auth', 'admin']);
Route::delete('api/{lecture}/deletevideo', 'LectureVideoController@destroy')->middleware(['auth', 'admin']);
Route::patch('api/{lecture}/updatevideo', 'LectureVideoController@update')->middleware(['auth', 'admin']);
Route::get('studyroom/{course}/getplaylist', 'LectureVideoController@playlist')->middleware(['auth', 'admin']);


Route::post('api/course/{course}/promovideo', 'PromoVideoController@store');
// Route::post('api/{lecture}/attachvideo', 'VideoController@store');

Route::post('api/{user}/awardexperience', 'ExperienceController@award')->middleware('admin');
Route::post('api/{user}/stripexperience', 'ExperienceController@strip')->middleware('admin');

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

Route::get('lectures/{lecture}', 'LectureController@show')->name('lecture.show');


Route::post('/courses', 'CourseController@store')->middleware('admin')->name('courses.store');
Route::patch('/courses/{course}', 'CourseController@update')->middleware('admin')->name('courses.update');
Route::get('/dashboard/courses/create', 'CourseController@create')->middleware('admin')->name('courses.create');
Route::get('/dashboard/{course}/manage', 'CourseController@edit')->middleware('admin')->name('courses.edit');
Route::get('/dashboard/{course}/publish', 'CourseController@publish')->middleware('admin')->name('courses.publish');
Route::get('/dashboard/{course}/unpublish', 'CourseController@unPublish')->middleware('admin')->name('courses.unPublish');

Route::get('/dashboard/users', 'ManageUserController@index')->middleware('admin')->name('manage_user.index');
Route::get('/finduserwithinvoices', 'ManageUserController@findUserWithInvoices')->middleware('admin');
Route::get('/dashboard/users/datatable', 'ManageUserController@getUsersForDataTable')->middleware('admin')->name('manage_user.datatables');
Route::get('/api/courses/viewAllCourses/datatable  ', 'Api\CoursesController@getCoursesForDataTable')->middleware('admin')->name('manage_courses.datatables');

Route::patch('/users/{user}/update', 'ManageUserController@update')->middleware('admin');
Route::patch('/users/{user}/updateprofile', 'ManageUserController@update')->name('update-profile');

Route::get('api/users/getallusers', 'ManageUserController@getallusers')->middleware('admin')->name('getallusers');


Route::get('/dashboard/updateprofile', 'UserController@edit')->name('update.settings.edit');
Route::patch('/dashboard/{user}/updateprofile', 'UserController@update')->name('update.settings.store');
Route::patch('/dashboard/{user}/updatepassword', 'UserController@updatePassword')->name('update.setting.password');
Route::get('/dashboard/{user}/mycourses', 'UserSubscribedCoursesController@index')->name('mycourses.index');
Route::get('/dashboard/{user}/getusercourses', 'UserSubscribedCoursesController@getDataForDataTable')->name('mycourses.datatable');
Route::get('/dashboard/user-rankings', 'ManageUserController@rankusers')->name('user_rankings');

Route::get('/dashboard/{user}/mypayments', 'UserPaymentsController@index')->name('mypayments.index');
Route::get('/dashboard/{user}/getuserpayments', 'UserPaymentsController@getDataForDataTable')->name('mypayments.datatable');

Route::post('/dashboard/{user}/createguardian', 'GuardianController@store')->name('guardian.store');
Route::patch('/dashboard/{guardian}/updateguardian', 'GuardianController@update')->name('guardian.update');

Route::get('/dashboard/{user}/manageinvoices', 'InvoiceController@index')->middleware('admin')->name('manage_invoice.index');
Route::get('/dashboard/{user}/createinvoice', 'InvoiceController@create')->middleware('admin')->name('manage_invoice.create');
Route::get('/findinvoice/{invoice}', 'InvoiceController@findinvoice')->middleware('admin');

Route::get('/dashboard/payments/addpayment', 'PaymentController@addpayment')->middleware('admin')->name('manage_invoice.addpayment');
Route::post('/dashboard/payments/addpayment', 'PaymentController@savepayments')->middleware('admin')->name('manage_invoice.savepayments');
Route::post('/dashboard/payments/refundpayment', 'PaymentController@refundPayment')->middleware('admin')->name('manage_invoice.refundpayment');

Route::post('/dashboard/invoices/createinvoiceforuser', 'InvoiceController@store')->middleware('admin')->name('manage_invoice.store');
Route::get('/dashboard/{user}/manageinvoices/datatable', 'InvoiceController@getallinvoices')->middleware('admin')->name('manage_invoice.getallinvoices');
Route::get('/api/invoices/getallinvoices', 'InvoiceController@retrieveallinvoices')->middleware('admin')->name('manage_invoice.retrieveallinvoices');

Route::get('/dashboard/billing/index', 'BillingController@index')->middleware('must-be-confirmed')->name('billing.home');
Route::get('/dashboard/{user}/getallinvoices', 'BillingController@getallinvoices')->middleware('must-be-confirmed')->name('billing.invoices');
Route::get('/dashboard/{invoice}/getinvoicepayments', 'BillingController@getinvoicepayments')->middleware('must-be-confirmed')->name('billing.payments');
Route::get('/dashboard/{user}/totalamountowed', 'BillingController@totalamountowed')->middleware('must-be-confirmed')->name('billing.totalamountowed');

Route::get('/dashboard/billing/{invoice}/clearinvoicedebt', 'BillingController@clearInvoiceDebt')->middleware('must-be-confirmed')->name('billing.clearinvoicedebt');
Route::get('/dashboard/billing/{invoice}/payspecifyamount', 'BillingController@specifyAmount')->middleware('must-be-confirmed')->name('billing.specifyAmount');

Route::get('/courses', 'CourseController@index')->name('courses');
Route::get('/courses/{subject}', 'CourseController@index');
Route::get('/courses/{subject}/{course}', 'CourseController@show');

Route::get('/program/{subject}/{course}', 'CourseController@show')->name('displayProgramDetails');

Route::get('/courses/{subject}/{course}/register', 'ProgramController@create');

Route::post('/subjects', 'SubjectController@store')->middleware('admin')->name('subjects.new');

Route::get('api/difficulties', 'Api\DifficultyController@index');
Route::get('api/types', 'Api\TypeController@index');

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

Route::patch('mark-message-as-read/{message}', 'MessageController@update')->middleware('admin');

Route::get('/users/generatecmdcard/{user}', 'PdfController@index');
Route::get('/users/activeusers', 'PdfController@activeusers')->middleware('admin')->name('permitcards');

Route::get('/{course}/outline', 'PdfController@outline')->name('courseoutline');

Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register.confirm');
Route::get('/register/resend', 'Auth\RegisterConfirmationController@resend')->name('register.resend_comfirmation');
Route::get('/register/comfirm_email', 'Auth\RegisterConfirmationController@create')->middleware('cannot-see-resend-link-page')->name('register.confirm_email');

Route::post('/register/verifytoken', 'Auth\RegisterConfirmationController@verifytoken')->middleware('cannot-see-resend-link-page')->name('register.verifytoken');
Route::post('/register/resendverifytoken', 'Auth\RegisterConfirmationController@resendverifytoken')->middleware('cannot-see-resend-link-page')->name('register.resendverifytoken');
Route::post('/password/phonereset', 'Auth\RegisterConfirmationController@phoneReset')->name('password.phone.reset');
Route::post('/password/resetUpdatePassword', 'Auth\RegisterConfirmationController@updatePassword')->name('password.update');

Route::post('/register/new_user', 'ManageUserController@store')->middleware('admin')->name('manage_user.store');

Route::post('/follow', 'FollowersController@store');


Route::get('/testing', 'TestingController@index'); // will be here temporary
Route::post('/testing', 'TestingController@store'); // will be here temporary

Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->middleware('auth')->name('avatar');
Route::post('api/users/{user}/passport', 'Api\UserAvatarController@storePassport')->middleware('auth')->name('passport');


Route::post('api/createclient', 'ClientController@store')->middleware('admin');
Route::post('api/client/{client}/image', 'ClientController@storePassport')->middleware('admin')->name('passport');
Route::delete('api/deleteclient/{client}', 'ClientController@destroy')->middleware('admin');
Route::patch('api/updateclient/{client}', 'ClientController@update')->middleware('admin');
Route::get('/clients', 'ClientController@index')->middleware('admin')->name('client.index');
Route::get('/generateclienttoken/{client}', 'ClientController@generatetoken')->middleware('admin')->name('client.generatetoken');

Route::get('/courses/{subject}/{course}/subscription', 'Payment\PaymentMethodController@index')->name('course_subscription.index')->middleware('auth', 'must-be-confirmed');
Route::post('/courses/{subject}/{course}/subscription', 'Payment\PaymentMethodController@store')->name('course_subscription.store')->middleware('auth', 'must-be-confirmed');
//Route::get('/courses/{subject}/{course}/callback', 'Payment\CourseSubscriptionController@update')->name('course_subscription.update')->middleware('auth');


Route::post('coporate/registration', 'CoporatetrainingController@store');
Route::get('coporate/registration', 'CoporatetrainingController@index');

Route::post('/courses/{subject}/{course}/paystack', 'PaystackSubscriptionController@makeFullPayment')->name('paystack.makeFullPayment');

Route::post('/courses/{subject}/{course}/paystackpart', 'PaystackSubscriptionController@makePartPayment')->name('paystack.makePartPayment');

Route::get('/studyroom/{course}', 'StudyRoomController@index')->middleware('must-be-subscribed')->name('studyroom.index');

Route::get('/pricing', 'BusinessController@index')->name('pricing.index');
Route::post('/business/{business}/thumbnail', 'BusinessController@thumbnail')->name('pricing.thumbnail');

Route::post('newtestimonial/{course}', 'TestimonialsController@store');
Route::get('testimonials/{course}', 'TestimonialsController@coursetestimonial');
Route::get('/testimonials', 'TestimonialsController@index');
Route::get('/clienttestimonial/{token}', 'ClienttestimonialController@show');
Route::post('/clienttestimonial/{token}', 'ClienttestimonialController@store');

Route::get('/api/{course}/lessonvideourl', 'ClassroomController@nextVideo')->middleware('must-be-confirmed');

Route::get('/build-a-website', 'StaticPageController@websiteDesign');

Route::get('/paid/submit_details', 'PaymentController@create')->name('pay.submitDetails');

Route::post('/send-a-message', 'MessageController@store')->name('message.stor');


Route::get('/payment/callback', 'PaystackSubscriptionController@handleGatewayCallback');
Route::get('/paid/{course}', 'PaymentController@paymentSuccessful');
Route::post('/paid/savedetails', 'PaymentController@store')->name('pay.saveDetails');

Route::get('/settings/getSiteLogo', 'SiteController@getSiteLogo')->name('site.logo');
Route::get('/settings/getTemplateLogo', 'SiteController@getTemplateLogo')->name('site.templates');




