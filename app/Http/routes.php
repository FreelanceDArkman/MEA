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


//    Route::get('/view',function() {
//        dd(Session::get('user_data'));
//    });



    Route::group(['middleware' => ['auth.frontend']], function() {
        // login required
    });
});


Route::group(['middleware' => ['backend'],'prefix' => 'admin'], function () {
    Route::get('login','Auth\AdminAuthController@showLogin');
    Route::post('login','Auth\AdminAuthController@checkLogin');
    Route::get('logout','Auth\AdminAuthController@checkLogout');

    Route::group(['middleware' => ['auth.backend']], function() {
        // login required
        Route::get('/', 'DashboardController@showIndex');

        Route::group(['prefix' => 'userGroup'] , function() {

            Route::get('/', 'UserGroupController@userGroups');
            Route::post('getUserGroups', 'UserGroupController@getUserGroups');
            Route::post('checkUserGroupIdExist','UserGroupController@UserGroupIdExist');
            Route::get('add', 'UserGroupController@getAddUserGroup');
            Route::post('add', 'UserGroupController@postAddUserGroup');
            Route::get('edit/{id}', 'UserGroupController@editUserGroup')->where('id', '[0-9]+');

        });

    });

});