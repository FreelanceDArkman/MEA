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

     Route::get('/','HomeController@getIndex');





    Route::get('/netasset','NetassetController@getIndex');

    Route::get('/economic','EconomicController@getIndex');

    Route::get('/announce','AnnounceController@getIndex');
    Route::get('/actfund','ActfundController@getIndex');
    Route::get('/board','BoardController@getIndex');
    Route::get('/fundregulations','FundreController@getIndex');
    Route::get('/fundboard','FundboardController@getIndex');
    Route::get('/structuralfunds','StrucController@getIndex');
    Route::get('/yearbook','YearbookController@getIndex');
    Route::get('/download','DownloadController@getIndex');
    Route::get('/test','TestController@getIndex');
    Route::get('/membershipform','MembershipfornController@getIndex');
    Route::get('/form','FormController@getIndex');
    Route::get('/otherforms','OtherFormController@getIndex');
    Route::get('/qa','QaController@getIndex');
    Route::get('/news','NewsController@getIndex');
    Route::get('/newsfund','NeesfundController@getIndex');
    Route::get('/contact','ContactController@getIndex');

    Route::get('/forservices','ForserviceController@getIndex');



    Route::group(['middleware' => ['auth.frontend']], function(){
        Route::get('/editprofile','editprofileController@getIndex');
        Route::get('/informationbeneficiary','InformationController@getIndex');
        Route::get('/resetpassword','ResetPassword@getIndex');
        Route::get('/trends','TrendsController@getIndex');
        Route::get('/reportingmemberbenefit','ReportController@getIndex');
        Route::get('/compares','comparesController@getIndex');
        Route::get('/changeplan','changeplanController@getIndex');
        Route::get('/historyinvestmentplan','historyinvestmentplanController@getIndex');
        Route::get('/cumulative','cumulativeController@getIndex');
        Route::get('/historycumulative','historycumulativeController@getIndex');
        Route::get('/riskassessment','riskassessmentController@getIndex');

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
            Route::get('edit/{id}', 'UserGroupController@getEditUserGroup')->where('id', '[0-9]+');
            Route::post('edit', 'UserGroupController@postEditUserGroup');
            Route::post('delete', 'UserGroupController@deleteUserGroup');

        });

        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UserController@users');
            Route::post('getUsers', 'UserController@getUsers');
            Route::get('add','UserController@getAddUser');
        });

    });

});