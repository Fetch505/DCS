<?php
use App\Http\Controllers\UserController;
//Route::get('clear_cache', function () {
//
//    \Artisan::call('cache:clear');
//    \Artisan::call('config:clear');
//    \Artisan::call('view:clear');
//    dd("Cache is cleared");
//
//});

Route::view('/working', 'empty_page', ['name' => 'working']);
Route::get('/change-language/{lang}','LanguageController@changeLanguagelanding');
Route::post('/language-chooser', 'LanguageController@changeLanguage');
Route::post('/language', [
    'before' => 'csrf', 'as' => 'language-chooser', 'uses' => 'LanguageController@changeLanguage'
]);

Route::group(['middleware' => 'role:superadmin'], function() {

  Route::group(['middleware' => 'role:superadmin,delete user'], function() {
      // Route for deleting users
      Route::get('/check', [UserController::class, 'deleteUser'])->name('user.delete');
  });

  // Route for greeting
  Route::get('/check/without', [UserController::class, 'greetPakistan'])->name('user.greet');
}); // inside role middleware

Route::get('/','LanguageController@landingPage')->name('/');
Route::get('blog','LanguageController@blog')->name('blog');
Route::get('blog/{blog}', 'LanguageController@showBlog')->name('showBlog');
Route::post('/monthly','LanguageController@monthlyFormData');
Route::post('/yearly','LanguageController@yearlyFormData');
Route::get('privacy','LanguageController@privacy')->name('privacy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('signup', 'Auth\RegisterUserController@register')->name('signup');

// Auth middleware
Route::group(['middleware' => 'auth'], function () {

    Route::group(['namespace' => 'Common'], function() {
        // All routes that are common for both admin and super-admin
      ////Area routes
      Route::resource('area','AreaController');
      Route::get('area/deleteArea/{area}', 'AreaController@deleteRecord')->name('area.delete');
      Route::get('/area/getAreas/{id}','AreaController@getAreas');

      ////Customer routes
      Route::resource('customer','CustomerController');
      Route::get('supcustomer', 'CustomerController@sup_index')->name('sup_customer.index');
      Route::get('sup_customer/create', 'CustomerController@sup_create')->name('sup_customer.create');
      Route::get('sup_customer/edit/{customer}', 'CustomerController@sup_edit')->name('sup_customer.edit');
      Route::get('sup_customer/show/{customer}', 'CustomerController@sup_show')->name('sup_customer.show');

      Route::get('customer/deleteCustomer/{customer}', 'CustomerController@deleteRecord')->name('customer.delete');

      Route::post('getAddressFromPostCode',
      'CustomerController@getAddressFromPostCode');

    });

    Route::group(['namespace' => 'SuperAdmin', 'middleware' => 'role:superadmin'], function() {

        Route::get('/superAdmin','SuperAdminController@index')->name('sup_admin.dashboard');
        Route::get('/adminDetail','SuperAdminController@adminDetail')->name('sup_admin.adminDetail');
        Route::get('/adminProfile','SuperAdminController@adminProfile')->name('sup_admin.profile');
        Route::post('/adminUpdateDetail','SuperAdminController@adminUpdateDetail')->name('sup_admin.updatedetail');

        /////////////// Migrated Routes from Customer routes starts here ///////////////
        Route::resource('modulePrice','ModulePriceController');

        ////Social Insurance routes
        Route::resource('socialInsurance','SocialInsuranceController');
        Route::get('insuranceDetail/{id}','SocialInsuranceController@insuranceDetail')->name('insuranceDetail');
        Route::get('hourlyRateIndex','SocialInsuranceController@hourlyRateIndex')->name('hourlyRateIndex');

        ////Employee Group routes
        Route::resource('employeeGroup','EmployeeGroupController');
        Route::get('emplGroupDetail/{id}','EmployeeGroupController@empGroupDetail');
        Route::get('emplInsuranceDetail','EmployeeGroupController@emplInsuranceDetail');

        ////workable days calculation routes
        Route::resource('workableDaysCalculation','WorkableDaysCalculationController');
        Route::get('workableDaysDetail/{workableDaysCalculation}','WorkableDaysCalculationController@workableDaysDetail');

        ////Floor routes
        // Route::resource('floor','FloorController');
        // Route::get('floor/deleteFloor/{floor}', 'FloorController@deleteRecord')->name('floor.delete');
        // Route::get('/area/getAreas/{id}','AreaController@getAreas');

        ////FloorType routes
        Route::resource('floorType','FloorTypeController');
        Route::get('floorType/deleteFloorType/{floorType}', 'FloorTypeController@deleteFloorType')->name('floorType.delete');

        ////Room Types routes
        Route::resource('roomType','RoomTypesController');
        Route::get('deleteRoomType/{id}','RoomTypesController@deleteType')->name('deleteRoomType');

        ////Task routes
        //Route::resource('task','TaskController');

        Route::get('task/getProjects/{id}','TaskController@getProjects');
        Route::get('task/getAreas/{id}','TaskController@getAreas');

        /*element routes*/
        //Route::resource('element','ElementController');
        //Route::get('element/deleteElement/{element}', 'ElementController@deleteRecord')->name('element.delete');


        /////////////// Migrated Routes from Customer routes ends here ///////////////

        Route::get('/companyManage','CompanyController@index')->name('supadmin.companiesIndex');
        Route::get('/createCompany','CompanyController@create')->name('supadmin.createCompany');
        Route::post('/saveCompany','CompanyController@store')->name('supadmin.saveCompany');
        Route::get('/edit/{id}','CompanyController@edit')->name('supadmin.edit');
        Route::post('/updateCompany/{id}','CompanyController@update')->name('supadmin.updateCompany');
        Route::get('/deleteCompany/{id}','CompanyController@destroy')->name('supadmin.deleteCompany');

        ///////////permissions
        Route::get('/permissionManage','PermissionController@index')->name('sup_admin.permissionsIndex');
        Route::get('/createPermission','PermissionController@create')->name('sup_admin.createPermission');
        Route::post('/savePermission','PermissionController@store')->name('sup_admin.savePermission');
        Route::get('/editPermission/{permission}','PermissionController@edit')->name('sup_admin.editPermission');
        Route::post('/updatePermission/{id}','PermissionController@update')->name('sup_admin.updatePermission');
        Route::get('/deletePermission/{permission}','PermissionController@destroy')->name('sup_admin.deletePermission');

        //////////roles
        Route::get('/roleManage','RoleController@index')->name('sup_admin.rolesIndex');
        Route::get('/createRole','RoleController@create')->name('sup_admin.createRole');
        Route::post('/saveRole','RoleController@store')->name('sup_admin.saveRole');
        Route::get('/editRole/{role}','RoleController@edit')->name('sup_admin.editRole');
        Route::post('/updateRole/{id}','RoleController@update')->name('sup_admin.updateRole');
        Route::get('/deleteRole/{role}','RoleController@destroy')->name('sup_admin.deleteRole');

        Route::get('/paymentManage','SuperAdminController@paymentManage')->name('sup_admin.payments');
        Route::get('/rolesManage','SuperAdminController@rolesManage')->name('sup_admin.roles');

        ////////// WorkerTypes
        Route::resource('workerTypes', 'WorkerTypesController');
        Route::get('workerTypes/deleteThisRecord/{id}', 'WorkerTypesController@deleteThisRecord')->name('workerTypes.delete');

        //Method routes
        Route::resource('method','MethodController');
        Route::get('method/deletemethod/{method}', 'MethodController@deleteRecord')->name('method.delete');

        //Method Category routes
        Route::resource('methodCategory','MethodCategoryController');

        //Health Category routes
        Route::resource('healthCategory','HealthCategoryController');

        //Health And Safety routes
        Route::resource('health','HealthAndSafetyController');
        Route::get('health/deletehealth/{health}', 'HealthAndSafetyController@deleteRecord')->name('health.delete');

        //Blog routes
        Route::resource('blogs','BlogController');
        Route::get('/blogs/delete/{id}', 'BlogController@delete')->name('blogs.delete'); 
        Route::get('/blogs/edit/{id}', 'BlogController@edit')->name('blogs.edit'); 
        Route::post('/blogs/update/{id}', 'BlogController@update')->name('blogs.update');

        ////////////////users
        Route::get('/workersIndex','UserController@index')->name('supadmin.workersIndex');
        Route::get('/createUser','UserController@create')->name('supadmin.createUser');
        Route::post('/saveUser','UserController@store')->name('supadmin.saveUser');
        Route::get('/viewUser/{user}','UserController@show')->name('supadmin.viewUser');
        Route::get('/editUser/{id}','UserController@edit')->name('supadmin.editUser');
        Route::post('/updateUser/{id}','UserController@update')->name('supadmin.updateUser');
        Route::get('/deleteUser/{id}','UserController@destroy')->name('supadmin.deleteUser');
        Route::get('/statusChange/{user}','UserController@statusChange')->name('supadmin.statusChange');
        // Route::get('/usersIndex','UserController@allUsers')->name('supadmin.usersIndex');
        // Route::get('/allusers','UserController@allUsers')->name('allusers');
        Route::get('/allusers','UserController@allUsers')->name('supadmin.allUsers');
        Route::get('/viewAllUser/{user}','UserController@viewAllUser')->name('supadmin.viewAllUser');

        Route::resource('users','UserController');
    });

    //CompanyAdmin Routes in this block
    Route::group(['namespace' => 'CompanyAdmin','middleware' => 'role:admin'], function() {

      Route::get('/inspectionIndex','InspectionReportController@index')->name('inspection.index');
      Route::get('/inspectionView/{id}','InspectionReportController@view')->name('inspection.view');
      Route::get('/downloadPdfReport/{id}','InspectionReportController@downloadPdfReport')->name('inspection.download');
      Route::post('/uploadreport','InspectionReportController@uploadReport')->name('uploadReport');
      Route::get('/getCustomerProjects/{id}','InspectionReportController@getCustomerProjects')->name('getCustomerProjects');
      Route::get('/externalreport','InspectionReportController@externalreportIndex')->name('externalreport');
      Route::get('/externalreportdata','InspectionReportController@externalreportdata')->name('externalreportdata');
      Route::get('/companyProjects', 'InspectionReportController@companyProjects');
      Route::post('/projectInspectionReport', 'InspectionReportController@projectInspectionReport');

      Route::get('/companyAdmin','CompanyAdminController@index')->name('com_admin.dashboard');
      Route::get('/companyProfile','CompanyAdminController@companyProfile')->name('com_admin.profile');
      Route::get('/companyDetail','CompanyAdminController@companyDetail')->name('com_admin.detail');
      Route::post('/companyUpdateDetail','CompanyAdminController@companyUpdateDetail')->name('com_admin.updatedetail');

      Route::resource('element','ElementController');
      Route::get('element/deleteElement/{element}', 'ElementController@deleteRecord')->name('element.delete');

      Route::get('/allelements','ElementController@allelements')->name('allelements');
      Route::resource('task','TaskController');

      Route::get('/alltasks','TaskController@alltasks')->name('alltasks');
      Route::get('task/deleteTask/{task}','TaskController@deleteRecord')->name('task.delete');

      /////Supplier routes
      Route::resource('supplier','SupplierController');
      Route::get('supplier/deleteSupplier/{supplier}', 'SupplierController@deleteRecord')->name('supplier.delete');

      ////Material Category routes
      Route::resource('materialCategory','MaterialCategoryController');
      Route::get('materialCategory/deleteMaterialCategory/{materialCategory}', 'MaterialCategoryController@deleteRecord')->name('materialCategory.delete');

      ////Material Type routes
      Route::resource('materialType','MaterialTypeController');
      Route::get('/getMaterialTypes/{categoryId}', 'MaterialTypeController@getMaterialTypes');
      Route::get('materialType/deleteMaterialType/{materialType}', 'MaterialTypeController@deleteRecord')->name('materialType.delete');

      ////material routes
      Route::resource('material','MaterialController');
      Route::get('order', 'MaterialController@order')->name('material-order');
      Route::post('order-materials', 'MaterialController@orderMaterials');
      Route::get('showMaterialOrders', 'MaterialController@showMaterialOrders')->name('showMaterialOrders');
      Route::get('MaterialOrderDetails/{orderId}', 'MaterialController@MaterialOrderDetails')->name('MaterialOrderDetails');

      ////Staff Type routes
      Route::resource('staffType','StaffTypeController');
      Route::get('staffType/deleteType/{id}', 'StaffTypeController@deleteRecord')->name('staffType.delete');

      ////Employment Agency routes
      Route::resource('employ_agency','EmployAgencyController');
      Route::get('employ_agency/deleteAgency/{employAgency}', 'EmployAgencyController@deleteRecord')->name('employ_agency.delete');

      //Assign Project Material routes
      Route::post('project/getTypes', 'AssignMaterialController@getTypes');
      Route::post('project/getMaterials', 'AssignMaterialController@getMaterials');
      Route::get('project/assign-materials', 'AssignMaterialController@assignMaterials')->name('project.assign-materials');
      Route::post('/store-materials/{projectId}', 'AssignMaterialController@storeMaterials')->name('project.store-materials');
      Route::get('project/material-transactions', 'AssignMaterialController@materialTransactions')->name('project.material-transactions');
      Route::get('project/material/assign-users', 'AssignMaterialController@assignedUsers')->name('material.assign-users');
      Route::post('project/material/user-assignments', 'AssignMaterialController@userAssignments')->name('material.user-assignments');

      ////Project routes
      Route::resource('project','ProjectController');
      Route::get('project/deleteProject/{project}', 'ProjectController@deleteRecord')->name('project.delete');
      Route::get('project/removeLocation/{id}', 'ProjectController@removeLocation')->name('project.removeLocation');
      Route::get('project/deleteJob/{id}/{project_id}', 'ProjectController@deleteJob')->name('project.deleteJob');
      Route::post('project/updateProject/{project}','ProjectController@updateProject')->name('project.updateProject');
      Route::get('projectDetails/{id}','ProjectController@projectDetails');
      Route::get('dayDetails/{id}', 'ProjectController@dayDetails');
      Route::post('saveEditJob/{id}', 'ProjectController@saveEditJob');
      Route::get('addDayDetails', 'ProjectController@addDayDetails'); //
      Route::get('getRelatedAreas/{id}', 'ProjectController@getRelatedAreas');
      Route::get('getRelatedElementTypes/{id}', 'ProjectController@getRelatedElementTypes');
      Route::get('getRelatedTasks/{id}', 'ProjectController@getRelatedTasks');
      Route::get('getRelatedWorkers/{id}', 'ProjectController@getRelatedWorkers');
      Route::post('updateProjectDetails/{id}', 'ProjectController@updateProjectDetails');
      //Planning routes
      Route::get('planning', 'PlanningController@index')->name('planning.index');
      Route::post('getProjectWorkers', 'PlanningController@getProjectWorkers')->name('getProjectWorkers');
      Route::post('unassignWorkers','PlanningController@unassignWorkers');
      Route::post('assignWorkers','PlanningController@assignWorkers');

      // add project new routes
      Route::get('getDetails','ProjectController@getDetails');
      Route::post('addProject','ProjectController@addProject');
      Route::post('getFloorAreaJobs','ProjectController@getFloorAreaJobs');
      Route::post('getFloorAreas','ProjectController@getFloorAreas');
      Route::get('projectAllJobPdf/{project_id}','ProjectController@projectAllJobPdf')->name('projectAllJobPdf');
      Route::get('projectJobPdf/{project_id}/{job_id}/{area_id}','ProjectController@projectJobPdf')->name('projectJobPdf');
      // add project new routes

      // project material quotes routes starts here
      Route::get('quotesIndex','MaterialQuotesController@quotesIndex')->name('quotesIndex');
      Route::get('quoteRequest/{id}','MaterialQuotesController@quoteRequest')->name('quoteRequest');
      Route::get('quoteList/{id}','MaterialQuotesController@quoteList')->name('quoteList');
      Route::get('projectList','MaterialQuotesController@projectList')->name('projectList');
      Route::get('materialList','MaterialQuotesController@materialList')->name('materialList');
      Route::post('placeOrder','MaterialQuotesController@placeOrder')->name('placeOrder');
      // project material quotes routes ends here

      ////Floor routes
      Route::resource('floor','FloorController');
      Route::get('floor/deleteFloor/{floor}', 'FloorController@deleteRecord')->name('floor.delete');

      //Project cost estimate routes starts here
      Route::resource('projectcostestimate', 'ProjectCostEstimateController');
      Route::get('deleteProjectCostEstimate/{id}', 'ProjectCostEstimateController@deleteEstimate')->name('deleteEstimate');
      Route::get('getprojectcostestiamte/{id}', 'ProjectCostEstimateController@getProjectCostEstimateDetail')->name('getprojectcostestiamte');
      Route::get('getAreaTaskElementTables/{id}/{area_id}', 'ProjectCostEstimateController@getAreaTaskElementTables')->name('getAreaTaskElementTables');
      Route::get('downloadEstimatePDF/{id}', 'ProjectCostEstimateController@downloadEstimatePDF')->name('downloadEstimatePDF');
      Route::get('/customersList','ProjectCostEstimateController@customerList');
      Route::get('/commentsList/{id}','ProjectCostEstimateController@commentsList');
      Route::get('/selectedRoomTypes/{id}','ProjectCostEstimateController@selectedRoomTypes');
      Route::post('/correctionStand','ProjectCostEstimateController@correctionStand');
      //Project cost estimate routes ends here
      
      //quotations routes
      Route::get('/quotations/{id}/send-pdf', 'QuotationController@sendQuotationPDF')->name('quotations.send-pdf');
      Route::resource('quotations','QuotationController');

      //Staff routes
      Route::resource('staff','StaffController');
      Route::get('staff/deleteArea/{user}', 'StaffController@deleteRecord')->name('staff.delete');
      Route::get('staff/statusChange/{user}', 'StaffController@statusChange')->name('staff.statusChange');
      Route::get('getStaffEditDetails/{id}', 'StaffController@getStaffEditDetails')->name('getStaffEditDetails');
      Route::get('staffPdf/{user_id}','StaffController@staffPdf')->name('staffPdf');
      Route::get('inactiveUser/{id}', 'StaffController@inactiveUser')->name('inactiveUser');

      //Method routes
      Route::get('viewMethods','MethodController@index')->name('methodsindex');

      //Health routes
      Route::get('healthAndSafety','HealthAndSafetyController@index')->name('healthAndSafety');

      //Shift routes
      Route::resource('shift','ShiftController');
      Route::get('shift/deleteshift/{shift}', 'ShiftController@deleteRecord')->name('shift.delete');

      //Worker Reports
      Route::resource('workerReport','WorkerReportController');
      Route::resource('worker-over-time-report','WorkerOverTimeController');
      Route::resource('erp-report','ErpReportController');
      Route::resource('expiry-report','ExpiryReportController');
      Route::post('getWorkerOverTime', 'WorkerOverTimeController@getWorkerOverTimeDetails')->name('getWorkerOverTime');
      Route::post('getErpReport', 'ErpReportController@getWorkerOverTimeDetails')->name('getErpReport');
      Route::post('getExpiryReport', 'ExpiryReportController@getWorkerOverTimeDetails')->name('getExpiryReport');
      Route::get('getprojectsforworker/{id}', 'WorkerReportController@getprojectsforworker')->name('getprojectsforworker');
      Route::PUT('updateReport/{id}', 'WorkerReportController@updateReport')->name('updateReport');
      Route::post('getWorkerTaskDetails', 'WorkerReportController@getWorkerTaskDetails')->name('getWorkerTaskDetails');

    });

    Route::group(['namespace' => 'Workers','middleware' => 'role:user'], function() {
      Route::get('/index','WorkerController@index')->name('workerIndex');
      Route::get('/workerDetails','WorkerController@workerDetails')->name('workerDetails');
      Route::get('/myJobs','WorkerController@myJobs')->name('myJobs');
      Route::get('/workerAllJobs','WorkerController@workerAllJobs')->name('workerDetails');
      Route::get('/startJob/{id}','WorkerController@startJob')->name('startJob');
      Route::get('/endJob/{id}','WorkerController@endJob')->name('endJob');
      Route::get('/checkJobStatus/{id}','WorkerController@checkJobStatus')->name('checkJobStatus');
      Route::get('/getWeekCards/{id}','WorkerController@getWeekCards')->name('getWeekCards');


    });

    Route::group(['namespace' => 'CustomerAdmin','middleware' => 'role:customer'], function() {
      Route::get('/myProjects','CustomerAdmin@myProjects')->name('customer.myProjects');
      Route::get('/viewProject/{project}','CustomerAdmin@projectDetail')->name('customer.projectDetail');
      Route::get('/myTasks','CustomerAdmin@myTasks')->name('customer.myTasks');

    });

});


// Route::resource('supplier','SupplierController');
