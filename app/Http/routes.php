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



    Route::post('/search','SearchController@getIndex');

    Route::get('/search','SearchController@getIndex');

    Route::get('/search_detail','SearchController@getDetail');





    Route::get('/contact','ContactController@getIndex');
    Route::post('/contact','ContactController@SendMail');


    Route::get('/forservices','ForserviceController@getIndex');



    Route::group(['middleware' => ['auth.frontend']], function(){

        Route::get('/profile','ProfileController@getIndex');




        Route::group(['prefix' => 'editprofile'] , function() {

            Route::get('/','editprofileController@getIndex');
            Route::get('{id}','editprofileController@getIndex')->where('id', '[0-9]+');
            Route::post('/e1','editprofileController@EditProfile');
            Route::post('/e2','editprofileController@ResetPassworduser');

        });

        Route::get('/resetpassword','editprofileController@getIndex');

        Route::get('/informationbeneficiary','editprofileController@getIndex');



        Route::group(['prefix' => 'trends'] , function() {

            Route::get('/','TrendsController@getIndex');
            Route::get('{id}','TrendsController@getIndex')->where('id', '[0-9]+');


            Route::post('/','TrendsController@getIndexbysearchColum');
//          Route::get('{id}','TrendsController@getIndexbysearchColum')->where('id', '[0-9]+');

           // Route::get('/s2','TrendsController@getIndex');
           // Route::get('/s2/{id}','TrendsController@getIndex')->where('id', '[0-9]+');
            Route::post('/s2','TrendsController@getIndexbysearchgp2');
            //Route::post('/s2/{id}','TrendsController@getIndexbysearchgp2')->where('id', '[0-9]+');


           Route::post('/s3','TrendsController@getIndexbysearchgpLastest');
           //Route::get('/s3','TrendsController@getIndex');


        });







        Route::get('/trends_excel1','TrendsController@ExportExcel1');
        Route::get('/trends_excel2','TrendsController@ExportExcel2');

        Route::get('/reportingmemberbenefit','TrendsController@getIndex');
        Route::get('/compares','TrendsController@getIndex');


//        Route::get('/changeplan','changeplanController@getIndex');


        Route::group(['prefix' => 'changeplan'] , function() {

            Route::get('/', 'changeplanController@getIndex');
            Route::get('{id}','changeplanController@getIndex')->where('id', '[0-9]+');
            Route::post('/changeplan','changeplanController@InsertInvestPlan');
            Route::get('/delplan1','changeplanController@deleplan');
            Route::post('/', 'changeplanController@getIndexbysearch');
            Route::post('{id}', 'changeplanController@getIndexbysearch')->where('id', '[0-9]+');
//            Route::post('{id}','changeplanController@getIndexbysearch')->where('id', '[0-9]+');
//            Route::get('{id}', 'QaController@getIndexByID')->where('id', '[0-9]+');


        });



        Route::get('/historyinvestmentplan','changeplanController@getIndex');


        Route::group(['prefix' => 'cumulative'] , function() {
            Route::get('/', 'cumulativeController@getIndex');
            Route::get('{id}','cumulativeController@getIndex')->where('id', '[0-9]+');
            Route::get('/delplan', 'cumulativeController@deleplan');
            Route::post('/cumulative', 'cumulativeController@InsertPlan');
            Route::post('/', 'cumulativeController@getIndexbysearch');
            Route::post('{id}', 'cumulativeController@getIndexbysearch')->where('id', '[0-9]+');
        });



        Route::get('/historycumulative','cumulativeController@getIndex');




        Route::get('/riskassessment','riskassessmentController@getIndex');

        Route::get('/quiz','riskassessmentController@getquiz');

        Route::post('/quiz','riskassessmentController@insertQuiz');


    });


});


Route::group(['middleware' => ['backend'],'prefix' => 'admin'], function () {
    Route::get('login','Auth\AdminAuthController@showLogin');
    Route::get('forgotpassword','Auth\AdminAuthController@showforgot');
    Route::post('forgotpassword','Auth\AdminAuthController@ReqPassword');


    Route::get('firstlogin','Auth\AdminAuthController@showfirstlogin');
    Route::post('firstlogin','Auth\AdminAuthController@ResetPassword');

    Route::post('login','Auth\AdminAuthController@checkLogin');
    Route::get('logout','Auth\AdminAuthController@checkLogout');

    Route::group(['middleware' => ['auth.backend']], function() {
        // login required
        Route::get('/', 'DashboardController@showIndex');
//        Route::get('/', 'UserGroupController@userGroups');


        Route::group(['prefix' => 'userGroup'] , function() {



            Route::get('/', 'UserGroupController@userGroups');
            Route::post('getUserGroups', 'UserGroupController@getUserGroups');
            Route::post('checkUserGroupIdExist','UserGroupController@UserGroupIdExist');
            Route::get('add', 'UserGroupController@getAddUserGroup');
            Route::post('add', 'UserGroupController@postAddUserGroup');
            Route::get('edit/{id}', 'UserGroupController@getEditUserGroup')->where('id', '[0-9]+');
            Route::post('edit', 'UserGroupController@postEditUserGroup');
            Route::post('delete', 'UserGroupController@deleteUserGroup');

            Route::post('ishave', 'UserGroupController@CheckUserGroup');


            Route::post('getall', 'UserGroupController@Ajax_GetUserGroup');


        });

        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UserController@users');
            Route::post('getUsers', 'UserController@getUsers');
            Route::get('add','UserController@getAddUser');
            Route::post('add','UserController@postAddUser');

            Route::get('edit/{id}', 'UserController@getEditUser')->where('id', '[0-9]+');
            Route::post('edit', 'UserController@postEditUser');
            Route::post('getall', 'UserController@Ajax_GetUser');
            Route::post('delete', 'UserController@deleteUser');
            Route::post('ReqPass', 'UserController@ReqPassword');

            Route::post('ReqPass_optional', 'UserController@ReqPassword_optional');

            Route::get('getimport','UserController@getimport');
            Route::post('import','UserController@importdata');

            Route::post('check','UserController@Checkdate');
            Route::post('import2','UserController@importdata2');

            Route::post('edit1', 'UserController@postEditUser1');
            Route::post('edit2', 'UserController@postEditUser2');

            Route::post('edit3', 'UserController@postEditUser3');


            Route::get('downloadsample', 'UserController@dowloadsample');
            Route::get('downloadsample2', 'UserController@dowloadsample2');
            Route::get('downloadsample3', 'UserController@dowloadsample3');


            Route::get('downloadsample_add', 'UserController@dowloadsample_add');
            Route::get('downloadsample_edit', 'UserController@dowloadsample_edit');
        });

        Route::group(['prefix' => 'simple'], function() {
            Route::get('/', 'UserManageController@getsimple');

            Route::post('import','UserManageController@importdata');
            Route::post('check','UserManageController@Checkdate');

            Route::get('downloadsample', 'UserManageController@dowloadsample');
        });

        Route::group(['prefix' => 'plan'], function() {
            Route::get('/', 'UserManagePlanController@getsimple');

            Route::post('import','UserManagePlanController@importdata');
            Route::post('check','UserManagePlanController@Checkdate');
            Route::get('downloadsample', 'UserManagePlanController@dowloadsample');

        });

        Route::group(['prefix' => 'fund'], function() {
            Route::get('/', 'UserManageFundController@getsimple');

            Route::post('import','UserManageFundController@importdata');
            Route::post('check','UserManageFundController@Checkdate');

            Route::get('downloadsample', 'UserManageFundController@dowloadsample');
        });
//
//
        Route::group(['prefix' => 'benefit'], function() {
            Route::get('/', 'UserManageBenefitcontroller@getsimple');

            Route::post('import','UserManageBenefitcontroller@importdata');
            Route::post('import_pdf','UserManageBenefitcontroller@importdata_pdf');

            Route::post('check','UserManageBenefitcontroller@Checkdate');

            Route::get('downloadsample', 'UserManageBenefitcontroller@dowloadsample');
        });
//
//
        Route::group(['prefix' => 'profit'], function() {
            Route::get('/', 'UserManageProfitController@getsimple');

            Route::post('import','UserManageProfitController@importdata');
            Route::post('check','UserManageProfitController@Checkdate');
            Route::get('downloadsample', 'UserManageProfitController@dowloadsample');

        });

        Route::group(['prefix' => 'extendrate'], function() {
            Route::get('/', 'UserManageExtendController@getsimple');

            Route::post('import','UserManageExtendController@importdata');
            Route::post('check','UserManageExtendController@Checkdate');
            Route::get('downloadsample', 'UserManageExtendController@dowloadsample');

        });

        Route::group(['prefix' => 'currentrate'], function() {
            Route::get('/', 'UserManageCurrentController@getsimple');

            Route::post('import','UserManageCurrentController@importdata');
            Route::post('check','UserManageCurrentController@Checkdate');

            Route::get('downloadsample', 'UserManageCurrentController@dowloadsample');
        });



        Route::group(['prefix' => 'chooseplan'], function() {

            Route::get('/', 'C52_1Controller@getindex');

            Route::get('add', 'C52_1Controller@getAdd');
            Route::post('add', 'C52_1Controller@postAdd');
            Route::get('edit/{id}', 'C52_1Controller@getEdit')->where('id', '[0-9]+');
            Route::post('edits', 'C52_1Controller@postEdit');
            Route::post('delete', 'C52_1Controller@delete');

            Route::post('getall', 'C52_1Controller@Ajax_Index');


        });

        Route::group(['prefix' => 'newstopic'], function() {

            Route::get('/', 'C53_1Controller@getindex');

            Route::get('add', 'C53_1Controller@getAdd');
            Route::post('add', 'C53_1Controller@postAdd');
            Route::get('edit/{id}', 'C53_1Controller@getEdit')->where('id', '[0-9]+');
            Route::post('edits', 'C53_1Controller@postEdit');
            Route::post('delete', 'C53_1Controller@delete');

            Route::post('getall', 'C53_1Controller@Ajax_Index');

            Route::post('menulist', 'C53_1Controller@Ajax_menulist');



        });


        Route::group(['prefix' => 'news'], function() {

            Route::get('/', 'C53_2Controller@getindex');

            Route::get('add', 'C53_2Controller@getAdd');
            Route::post('add', 'C53_2Controller@postAdd');
            Route::get('edit/{id}', 'C53_2Controller@getEdit')->where('id', '[0-9,]+');
            Route::post('edits', 'C53_2Controller@postEdit');
            Route::post('delete', 'C53_2Controller@delete');

            Route::post('getall', 'C53_2Controller@Ajax_Index');

            Route::post('menulist', 'C53_2Controller@Ajax_menulist');

            Route::post('imageupload', 'C53_2Controller@imageupload');



        });

        Route::group(['prefix' => 'faqcate'], function() {

            Route::get('/', 'C54_1Controller@getindex');

            Route::get('add', 'C54_1Controller@getAdd');
            Route::post('add', 'C54_1Controller@postAdd');
            Route::get('edit/{id}', 'C54_1Controller@getEdit')->where('id', '[0-9,]+');
            Route::post('edits', 'C54_1Controller@postEdit');
            Route::post('delete', 'C54_1Controller@delete');

            Route::post('getall', 'C54_1Controller@Ajax_Index');

            Route::post('menulist', 'C54_1Controller@Ajax_menulist');

            Route::post('imageupload', 'C54_1Controller@imageupload');



        });
        Route::group(['prefix' => 'faqtopic'], function() {

            Route::get('/', 'C54_2Controller@getindex');

            Route::get('add', 'C54_2Controller@getAdd');
            Route::post('add', 'C54_2Controller@postAdd');
            Route::get('edit/{id}', 'C54_2Controller@getEdit')->where('id', '[0-9,]+');
            Route::post('edits', 'C54_2Controller@postEdit');
            Route::post('delete', 'C54_2Controller@delete');

            Route::post('getall', 'C54_2Controller@Ajax_Index');

            Route::post('menulist', 'C54_2Controller@Ajax_menulist');

            Route::post('imageupload', 'C54_2Controller@imageupload');


        });


        Route::group(['prefix' => 'contact'], function() {

            Route::get('/', 'C55_1Controller@getindex');
            Route::post('add', 'C55_1Controller@postAdd');

        });





        Route::group(['prefix' => 'risk'], function() {

            Route::get('/', 'C56_1Controller@getindex');

            Route::post('getall', 'C56_1Controller@Ajax_Index');
            Route::get('add', 'C56_1Controller@getAdd');
            Route::post('add', 'C56_1Controller@postAdd');


            Route::get('edit/{id}', 'C56_1Controller@getEdit')->where('id', '[0-9,]+');
            Route::post('ishave', 'C56_1Controller@CheckUserGroup');
            Route::post('period', 'C56_1Controller@addperiod');
            Route::post('getperiod', 'C56_1Controller@ajax_getperiod');
            Route::post('editperiod', 'C56_1Controller@ajax_editperiod');
            Route::post('deleteperiod', 'C56_1Controller@ajax_deleteperiod');

            Route::post('question', 'C56_1Controller@addquestion');
            Route::post('getquestion', 'C56_1Controller@ajax_getquestion');
            Route::post('editquestion', 'C56_1Controller@ajax_editquestion');
            Route::post('deletequestion', 'C56_1Controller@ajax_deletequestion');

            Route::post('updateflag', 'C56_1Controller@ajax_updateflag');

            Route::post('delete', 'C56_1Controller@ajax_deleteQuiz');



        });

        Route::group(['prefix' => 'nav'], function() {

            Route::get('/', 'C57_1Controller@getindex');
            Route::post('getlist', 'C57_1Controller@getSearch');
            Route::get('getadd', 'C57_1Controller@getAdd');
            Route::post('addsave', 'C57_1Controller@Navsave');
            Route::post('editsave', 'C57_1Controller@editsave');
            Route::post('deletenav', 'C57_1Controller@deletenav');


        });


        Route::group(['prefix' => 'con1'], function() {

            Route::get('/', 'C59_1Controller@getindex');
            Route::post('getlist', 'C59_1Controller@getSearch');
            Route::post('addsave', 'C59_1Controller@Navsave');
            Route::post('editsave', 'C59_1Controller@editsave');
            Route::post('deletenav', 'C59_1Controller@deletenav');
        });

        Route::group(['prefix' => 'con3'], function() {

            Route::get('/', 'C59_3Controller@getindex');
            Route::post('getlist', 'C59_3Controller@getSearch');
            Route::post('addsave', 'C59_3Controller@Navsave');
            Route::post('editsave', 'C59_3Controller@editsave');
            Route::post('deletenav', 'C59_3Controller@deletenav');
        });

        Route::group(['prefix' => 'con4'], function() {

            Route::get('/', 'C59_4Controller@getindex');
            Route::post('getlist', 'C59_4Controller@getSearch');
            Route::post('addsave', 'C59_4Controller@Navsave');
            Route::post('editsave', 'C59_4Controller@editsave');
            Route::post('deletenav', 'C59_4Controller@deletenav');
        });




        Route::group(['prefix' => 'cmail'], function() {

            Route::get('/', 'C55_2Controller@getindex');
            Route::post('add', 'C55_2Controller@postAdd');
            Route::post('getall', 'C55_2Controller@Ajax_Index');

            Route::get('forward/{id}', 'C55_2Controller@getforward')->where('id', '[0-9,]+');
            Route::get('reply/{id}', 'C55_2Controller@getreply')->where('id', '[0-9,]+');

            Route::post('reply', 'C55_2Controller@SendReply');
            Route::post('forward', 'C55_2Controller@SendForward');
        });


//        Report Start

        Route::group(['prefix' => 'report1'], function() {
            Route::get('/', 'AdminReportController@getreport1');
            Route::post('/all', 'AdminReportController@ajax_report1');
            Route::post('/search', 'AdminReportController@ajax_report1_search');

            Route::post('/search_ana', 'AdminReportController@ajax_report1_search_ana');

            Route::get('/exportsearch', 'AdminReportController@ajax_report1_search_export');
            Route::get('/exportsearch_ana', 'AdminReportController@ajax_report1_search_ana_export');
            Route::get('/exportall', 'AdminReportController@ajax_report1_all_export');


            Route::get('/exportsearch_txt', 'AdminReportController@ajax_report1_search_export_txt');

            Route::get('/exportall_text2', 'AdminReportController@ajax_report1_all_export_text');



        });
        Route::group(['prefix' => 'report2'], function() {
            Route::get('/', 'AdminReport2Controller@getreport2');
            Route::post('/search', 'AdminReport2Controller@ajax_report2_search');
            Route::get('/exportsearch', 'AdminReport2Controller@ajax_report2_search_export');

        });

        Route::group(['prefix' => 'report3'], function() {
            Route::get('/', 'AdminReport3Controller@getreport');
            Route::post('/search', 'AdminReport3Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport3Controller@ajax_report_search_export');

        });

        Route::group(['prefix' => 'report4'], function() {
            Route::get('/', 'AdminReport4Controller@getreport');
            Route::post('/search', 'AdminReport4Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport4Controller@ajax_report_search_export');

        });

        Route::group(['prefix' => 'report5'], function() {
            Route::get('/', 'AdminReport5Controller@getreport');
            Route::post('/search', 'AdminReport5Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport5Controller@ajax_report_search_export');

        });

        Route::group(['prefix' => 'report6'], function() {
            Route::get('/', 'AdminReport6Controller@getreport');
            Route::post('/search', 'AdminReport6Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport6Controller@ajax_report_search_export');

        });

        Route::group(['prefix' => 'report7'], function() {
            Route::get('/', 'AdminReport7Controller@getreport');
            Route::post('/search', 'AdminReport7Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport7Controller@ajax_report_search_export');

        });


        Route::group(['prefix' => 'report8'], function() {
            Route::get('/', 'AdminReport8Controller@getreport');
            Route::post('/search', 'AdminReport8Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport8Controller@ajax_report_search_export');

        });

        Route::group(['prefix' => 'report9'], function() {
            Route::get('/', 'AdminReport9Controller@getreport');
            Route::post('/search', 'AdminReport9Controller@ajax_report_search');
            Route::post('/search2', 'AdminReport9Controller@ajax_report_search2');
            Route::get('/exportsearch', 'AdminReport9Controller@ajax_report_search_export');
            Route::get('/exportsearch2', 'AdminReport9Controller@ajax_report_search_export2');

        });

        Route::group(['prefix' => 'report10'], function() {
            Route::get('/', 'AdminReport10Controller@getreport');
            Route::post('/search', 'AdminReport10Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport10Controller@ajax_report_search_export');

        });
        Route::group(['prefix' => 'report11'], function() {
            Route::get('/', 'AdminReport11Controller@getreport');
            Route::post('/search', 'AdminReport11Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport11Controller@ajax_report_search_export');

        });
        Route::group(['prefix' => 'report12'], function() {
            Route::get('/', 'AdminReport12Controller@getreport');
            Route::post('/search', 'AdminReport12Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport12Controller@ajax_report_search_export');

        });

        Route::group(['prefix' => 'report13'], function() {
            Route::get('/', 'AdminReport13Controller@getreport');
            Route::post('/search', 'AdminReport13Controller@ajax_report_search');
            Route::get('/exportsearch', 'AdminReport13Controller@ajax_report_search_export');

        });


//        Route::group(['prefix' => 'report2'], function() {
//            Route::get('/', 'AdminReportController@getreport2');
//
//        });
//        Route::group(['prefix' => 'report3'], function() {
//            Route::get('/', 'AdminReportController@getreport3');
//
//        });
//        Route::group(['prefix' => 'report4'], function() {
//            Route::get('/', 'AdminReportController@getreport4');
//
//        });
//        Route::group(['prefix' => 'report5'], function() {
//            Route::get('/', 'AdminReportController@getreport5');
//
//        });
//        Route::group(['prefix' => 'report6'], function() {
//            Route::get('/', 'AdminReportController@getreport6');
//
//        });
//        Route::group(['prefix' => 'report7'], function() {
//            Route::get('/', 'AdminReportController@getreport7');
//
//        });
//        Route::group(['prefix' => 'report8'], function() {
//            Route::get('/', 'AdminReportController@getreport8');
//
//        });
//        Route::group(['prefix' => 'report9'], function() {
//            Route::get('/', 'AdminReportController@getreport9');
//
//        });
//        Route::group(['prefix' => 'report10'], function() {
//            Route::get('/', 'AdminReportController@getreport10');
//
//        });
//        Route::group(['prefix' => 'report11'], function() {
//            Route::get('/', 'AdminReportController@getreport11');
//
//        });
//        Route::group(['prefix' => 'report12'], function() {
//            Route::get('/', 'AdminReportController@getreport12');
//
//        });
//        Route::group(['prefix' => 'report13'], function() {
//            Route::get('/', 'AdminReportController@getreport13');
//
//        });

//        end report



    });

});