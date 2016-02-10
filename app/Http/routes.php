<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('login','Auth\AuthController@showLogin');
    Route::post('login','Auth\AuthController@checkLogin');
    Route::get('logout','Auth\AuthController@checkLogout');

    Route::get('/', 'HomeController@getIndex');
    Route::get('/home','HelloWorldController@getIndex');
    Route::get('/view',function() {
        dd(Session::get('user_data'));
    });
});


Route::group(['middleware' => ['backend'], 'prefix' => 'admin'], function () {
    Route::get('/', function() {
        if(Session::get('admin_logged_in')) {
            return redirect()->to('admin/dashboard');
        } else {
            return redirect()->to('admin/login');
        }
    });

    Route::get('/dashboard', function() {
        return 'OK';
    });
    Route::get('login','Auth\AdminAuthController@showLogin');
    Route::post('login','Auth\AdminAuthController@checkLogin');
    Route::get('logout','Auth\AdminAuthController@checkLogout');
});