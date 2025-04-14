<?php

Route::group([
    'prefix' => 'auth',
    'namespace' => 'APIs'

], function ($router) {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('updatepassword', 'AuthController@updatepassword');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

});

Route::group([
    'middleware' => 'JWT',
    'namespace' => 'APIs'
],function(){
    Route::get('/dailyJobsCount','EmployeeController@home');
    Route::get('/allWeeklyJobs','EmployeeController@allWeeklyJobs');
    Route::get('/allDailyJobs','EmployeeController@allDailyJobs');

    Route::get('/projectsList','ApiProjectController@projectsList');
    Route::post('/projectDetail/{id}','ApiProjectController@projectDetail');
    Route::get('/projectWorkers/{id}/location/{location_id}','ApiProjectController@projectWorkers');
    Route::get('/myTodayTasks/{project_id}/locationId/{location_id}','ApiProjectController@myTodayTasks')->name('myTodayTasks');

    Route::get('/myNotifications','ApiNotificationController@myNotifications')->name('myNotifications');
    Route::get('/markread/{id}','ApiNotificationController@markread')->name('markread');

    Route::get('/customersList','ApiCustomerController@customerList');
    Route::post('/customerDetail/{id}','ApiCustomerController@customerDetail');

    Route::get('/methods_list','ApiMethodController@methodsList');
    Route::get('/method_detail/{id}','ApiMethodController@methodDetail');

    Route::get('/health_list','ApiHealthController@List');
    Route::get('/health_detail/{id}','ApiHealthController@Detail');

    Route::post('/jobsList/{id}','ApiJobsController@projectJobsList');
    Route::post('/jobDetail/{id}','ApiJobsController@jobDetail');
    Route::post('/jobTasksList/{id}','ApiJobsController@jobTasksList');
    Route::post('/taskDetail/{id}','ApiJobsController@jobTaskDetail');
    Route::post('/startJobTime','ApiJobsController@startJobTime');
    Route::post('/endJobTime','ApiJobsController@endJobTime');

    ///////APIs for Leaves starts from here /////////
    Route::post('/leaverequest','ApiLeaveController@leaverequest')->name('leaverequest');
    Route::get('/myleaves','ApiLeaveController@myleaves')->name('myleaves');

    Route::get('/myrejectedleaves','ApiLeaveController@myrejectedleaves')->name('myrejectedleaves');
    Route::get('/leavepermission','ApiLeaveController@leavePermission')->name('leavepermission');
    ///////APIs for Leaves ends from here /////////

    /////////APIs for Supervisor starts from here ////////
    Route::get('/myworkers','ApiSupervisorController@myworkers')->name('myworkers');
    Route::get('/supervisorworkers/{id}','ApiSupervisorController@supervisorworkers')->name('supervisorworkers');
    Route::get('/projectworkers/{id}/location/{location_id}','ApiSupervisorController@projectworkers')->name('projectworkers');
    Route::get('/supervisorProjects','ApiSupervisorController@supervisorProjects')->name('supervisorProjects');
    Route::post('/workerWeekCards','ApiSupervisorController@workerWeekCards')->name('workerWeekCards');
    Route::post('/workerTimeCards','ApiSupervisorController@workerTimeCards')->name('workerTimeCards');
    Route::post('/updateReport/{id}', 'ApiSupervisorController@updateReport')->name('updateReport');
    Route::post('/supleavemark','ApiSupervisorController@supleavemark')->name('supleavemark');
    Route::post('/manleavemark','ApiSupervisorController@manleavemark')->name('manleavemark');
    Route::post('/completedtasksofday','ApiSupervisorController@completedtasksofday')->name('completedtasksofday');
    Route::post('/ratetask','ApiSupervisorController@ratetask')->name('ratetask');
    Route::post('/inspectionreview','ApiSupervisorController@inspectionreview')->name('inspectionreview');
    Route::post('/getinspectionreview','ApiSupervisorController@getinspectionreview')->name('getinspectionreview');
    Route::get('/workerleavelist/{id}','ApiSupervisorController@workerleavelist')->name('workerleavelist');
    Route::post('/replacementRequest','ReplacementRequestController@makeRequest');
    /////////APIs for Supervisor ends here ///////////////

});
