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

    Route::get('forgotpassword','Auth\AuthController@showForgotPassword');
    Route::post('forgotpassword','Auth\AuthController@GetPassword');

   Route::get('firstlogin','Auth\AuthController@ShowSetNewpass');
    Route::post('firstlogin','Auth\AuthController@ResetPassword');








    Route::get('/valuefund','ValueFundController@getIndex');
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


    Route::group(['prefix' => 'qa'] , function() {

        Route::get('/', 'QaController@getIndex');
        Route::get('{id}', 'QaController@getIndexByID')->where('id', '[0-9]+');


    });


    Route::group(['prefix' => '/'] , function($id) {

        Route::get('/','HomeController@getIndex');
        Route::post('/viewrecord','HomeController@viewrecord');
        Route::get('{id}','HomeController@getIndexByID')->where('id', '[0-9]+');
//        Route::get('download/{file}','HomeController@DownloadFile');
        Route::get('download/{id}','HomeController@DownloadFile');
        Route::get('view/{id}','HomeController@ViewFile');


    });

    Route::group(['prefix' => '/newsfund'] , function($id) {

        Route::get('/','NeesfundController@getIndex');
        Route::post('/viewrecord','NeesfundController@viewrecord');
        Route::get('{id}','NeesfundController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','NeesfundController@DownloadFile');
        Route::get('view/{id}','NeesfundController@ViewFile');

    });






    Route::get('/news','NewsController@getIndex');



    Route::get('/contact','ContactController@getIndex');

    Route::get('/forservices','ForserviceController@getIndex');



    Route::group(['middleware' => ['auth.frontend']], function(){

        Route::get('/profile','ProfileController@getIndex');


        Route::group(['prefix' => 'editprofile'] , function() {

            Route::get('/','editprofileController@getIndex');
            Route::post('/e1','editprofileController@EditProfile');
            Route::post('/e2','editprofileController@ResetPassworduser');

        });

        Route::get('/resetpassword','editprofileController@getIndex');

        Route::get('/informationbeneficiary','editprofileController@getIndex');



        Route::group(['prefix' => 'trends'] , function() {
            Route::get('/','TrendsController@getIndex');

            Route::post('/','TrendsController@getIndexbysearchColum');

            Route::get('/s2','TrendsController@getIndex');
            Route::post('/s2','TrendsController@getIndexbysearchgp2');


           Route::post('/s3','TrendsController@getIndexbysearchgpLastest');
            Route::get('/s3','TrendsController@getIndex');
        });







        Route::get('/trends_excel1','TrendsController@ExportExcel1');
        Route::get('/trends_excel2','TrendsController@ExportExcel2');

        Route::get('/reportingmemberbenefit','TrendsController@getIndex');
        Route::get('/compares','TrendsController@getIndex');


//        Route::get('/changeplan','changeplanController@getIndex');


        Route::group(['prefix' => 'changeplan'] , function() {

            Route::get('/', 'changeplanController@getIndex');
            Route::post('/changeplan','changeplanController@InsertInvestPlan');
            Route::get('/delplan1','changeplanController@deleplan');
            Route::post('/', 'changeplanController@getIndexbysearch');
//            Route::get('{id}', 'QaController@getIndexByID')->where('id', '[0-9]+');


        });



        Route::get('/historyinvestmentplan','changeplanController@getIndex');


        Route::group(['prefix' => 'cumulative'] , function() {
            Route::get('/', 'cumulativeController@getIndex');
            Route::get('/delplan', 'cumulativeController@deleplan');
            Route::post('/cumulative', 'cumulativeController@InsertPlan');
            Route::post('/', 'cumulativeController@getIndexbysearch');
        });



        Route::get('/historycumulative','cumulativeController@getIndex');




        Route::get('/riskassessment','riskassessmentController@getIndex');

        Route::get('/quiz','riskassessmentController@getquiz');

        Route::post('/quiz','riskassessmentController@insertQuiz');


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