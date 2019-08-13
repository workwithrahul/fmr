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
    return Redirect::to('login');
});
Auth::routes();
Route::post('/is/username/exist',"UserController@checkUserName");
Route::post('/add/user',"UserController@createUser");
Route::get('/home',"UserController@homeView");
Route::get('logout', 'Auth\LoginController@logout', function () {
    return Redirect::to('login');
});
Route::post('/user/login',"UserController@login");
Route::get('/verify',"UserController@verifyOtpView");
Route::post('/verify/otp',"UserController@verifyOtp");
Route::post('/resend/otp',"UserController@resendOtp");
Route::get('/forgot/password',"UserController@forgotPasswordView");
Route::get('/send/forgot/password/email',"UserController@forgotPassword");
Route::post('/search/name',"UserController@searchName");


Route::group(['prefix' => 'admin'], function(){
	
	Route::get('/dashboard',"Admin\AdminController@dashboard");
	Route::get('/add',"Admin\AdminController@addNewUser");
	Route::post('/add/new/user',"Admin\AdminController@addUser");
	Route::get('/delete/user/{id}',"Admin\AdminController@deleteUser");
	Route::get('/user/edit/{id}',"Admin\AdminController@editUser");
	Route::post('/update/user/details',"Admin\AdminController@updateUserDetails");
	Route::get('/records',"Admin\AdminController@getRecords");


});

// Api Routes

Route::group(['prefix' => 'api/v1'], function(){
	
	Route::post('/add/nextid',"Api\UserController@createUser");
	Route::post('/is/nextid/exist',"Api\UserController@checkUserName");
	Route::post('/login',"Api\UserController@login");
	Route::post('/forgotPassword',"Api\UserController@forgotPassword");
	Route::post('/verify/otp',"Api\UserController@verifyOtp");
	Route::post('/resend/otp',"Api\UserController@resendOtp");

});
