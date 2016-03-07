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




    Route::group(['prefix' => '/'] , function() {

        Route::get('/','HomeController@getIndex');
        Route::post('/viewrecord','HomeController@viewrecord');
        Route::get('{id}','HomeController@getIndexByID')->where('id', '[0-9]+');
//        Route::get('download/{file}','HomeController@DownloadFile');
        Route::get('download/{id}','HomeController@DownloadFile');
        Route::get('view/{id}','HomeController@ViewFile');


    });



    Route::get('/valuefund','ValueFundController@getIndex');



//    Route::get('/netasset','NetassetController@getIndex');


    Route::group(['prefix' => '/netasset'] , function() {
        Route::get('/','NetassetController@getIndex');

        Route::post('/viewrecord','NetassetController@viewrecord');
        Route::get('{id}','NetassetController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','NetassetController@DownloadFile');
        Route::get('view/{id}','NetassetController@ViewFile');


    });


//
//
//    Route::get('/economic','EconomicController@getIndex');


    Route::group(['prefix' => '/economic'] , function() {
        Route::get('/','EconomicController@getIndex');

        Route::post('/viewrecord','EconomicController@viewrecord');
        Route::get('{id}','EconomicController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','EconomicController@DownloadFile');
        Route::get('view/{id}','EconomicController@ViewFile');


    });



//    Route::get('/announce','AnnounceController@getIndex');

    Route::group(['prefix' => '/announce'] , function() {
        Route::get('/','AnnounceController@getIndex');

        Route::post('/viewrecord','AnnounceController@viewrecord');
        Route::get('{id}','AnnounceController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','AnnounceController@DownloadFile');
        Route::get('view/{id}','AnnounceController@ViewFile');


    });

//    Route::get('/actfund','ActfundController@getIndex');

    Route::group(['prefix' => '/actfund'] , function() {
        Route::get('/','ActfundController@getIndex');

        Route::post('/viewrecord','ActfundController@viewrecord');
        Route::get('{id}','ActfundController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','ActfundController@DownloadFile');
        Route::get('view/{id}','ActfundController@ViewFile');


    });

//    Route::get('/board','BoardController@getIndex');

    Route::group(['prefix' => '/board'] , function() {
        Route::get('/','BoardController@getIndex');

        Route::post('/viewrecord','BoardController@viewrecord');
        Route::get('{id}','BoardController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','BoardController@DownloadFile');
        Route::get('view/{id}','BoardController@ViewFile');


    });
//    Route::get('/fundregulations','FundreController@getIndex');
    Route::group(['prefix' => '/fundregulations'] , function() {
        Route::get('/','FundreController@getIndex');

        Route::post('/viewrecord','FundreController@viewrecord');
        Route::get('{id}','FundreController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','FundreController@DownloadFile');
        Route::get('view/{id}','FundreController@ViewFile');


    });


    Route::get('/fundboard','FundboardController@getIndex');
    Route::get('/structuralfunds','StrucController@getIndex');


    //Route::get('/download','DownloadController@getIndex');
    Route::get('/test','TestController@getIndex');

    Route::group(['prefix' => '/test'] , function() {
        Route::get('/','TestController@getIndex');

        Route::post('/viewrecord','TestController@viewrecord');
        Route::get('{id}','TestController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','TestController@DownloadFile');
        Route::get('view/{id}','TestController@ViewFile');


    });

//    Route::get('/membershipform','MembershipfornController@getIndex');
    Route::group(['prefix' => '/membershipform'] , function() {
        Route::get('/','MembershipfornController@getIndex');

        Route::post('/viewrecord','MembershipfornController@viewrecord');
        Route::get('{id}','MembershipfornController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','MembershipfornController@DownloadFile');
        Route::get('view/{id}','MembershipfornController@ViewFile');


    });

//    Route::get('/form','FormController@getIndex');
    Route::group(['prefix' => '/form'] , function() {
        Route::get('/','FormController@getIndex');

        Route::post('/viewrecord','FormController@viewrecord');
        Route::get('{id}','FormController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','FormController@DownloadFile');
        Route::get('view/{id}','FormController@ViewFile');


    });
//    Route::get('/otherforms','OtherFormController@getIndex');
    Route::group(['prefix' => '/otherforms'] , function() {
        Route::get('/','OtherFormController@getIndex');

        Route::post('/viewrecord','OtherFormController@viewrecord');
        Route::get('{id}','OtherFormController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','OtherFormController@DownloadFile');
        Route::get('view/{id}','OtherFormController@ViewFile');


    });


    Route::group(['prefix' => 'qa'] , function() {

        Route::get('/', 'QaController@getIndex');
        Route::get('{id}', 'QaController@getIndexByID')->where('id', '[0-9]+');


    });




    Route::group(['prefix' => '/newsfund'] , function() {

        Route::get('/','NeesfundController@getIndex');
        Route::post('/viewrecord','NeesfundController@viewrecord');
        Route::get('{id}','NeesfundController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','NeesfundController@DownloadFile');
        Route::get('view/{id}','NeesfundController@ViewFile');

    });


    Route::group(['prefix' => '/news'] , function() {
        Route::get('/','NewsController@getIndex');

        Route::post('/viewrecord','NewsController@viewrecord');
        Route::get('{id}','NewsController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','NewsController@DownloadFile');
        Route::get('view/{id}','NewsController@ViewFile');

    });




    Route::group(['prefix' => '/yearbook'] , function() {
        Route::get('/','YearbookController@getIndex');

        Route::post('/viewrecord','YearbookController@viewrecord');
        Route::get('{id}','YearbookController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','YearbookController@DownloadFile');
        Route::get('view/{id}','YearbookController@ViewFile');


    });

    Route::group(['prefix' => '/downloads'] , function() {

        Route::get('/','DownloadController@getIndex');

        Route::post('/viewrecord','DownloadController@viewrecord');
        Route::get('{id}','DownloadController@getIndexByID')->where('id', '[0-9]+');

        Route::get('download/{id}','DownloadController@DownloadFile');
        Route::get('view/{id}','DownloadController@ViewFile');

    });









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