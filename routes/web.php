<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(['permissions.policy'])->group(function () {
    Route::middleware('referrer-policy')->group(function () {

Route::get('/login', function () {
    return view('admin.login');
});

Route::get('/4BMkMvsUzt', ['as' => '/4BMkMvsUzt', 'uses' => 'App\Http\Controllers\Admin\ErrorLogsController@index']);
Route::post('/show-error', ['as' => '/show-error', 'uses' => 'App\Http\Controllers\Admin\ErrorLogsController@show']);
Route::post('/resolve-error', ['as' => '/resolve-error', 'uses' => 'App\Http\Controllers\Admin\ErrorLogsController@resolve']);

Route::get('/error-handling', ['as' => 'error-handling', 'uses' => 'App\Http\Controllers\ErrorHandlingController@errorHandling']);

Route::get('/login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\LoginController@index']);
// Route::post('/submitLogin', ['as' => 'submitLogin', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\LoginController@submitLogin']);
Route::post('/submitLogin', 'App\Http\Controllers\Admin\LoginRegister\LoginController@submitLogin')->name('submitLogin');

// ================================================
Route::group(['middleware' => ['admin']], function () {
    Route::get('/dashboard', ['as' => '/dashboard', 'uses' => 'App\Http\Controllers\Admin\Dashboard\DashboardController@index']);
    Route::get('/list-users', ['as' => 'list-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@index']);
    Route::get('/add-users', ['as' => 'add-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@addUsers']);
    Route::post('/add-users', ['as' => 'add-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@register']);
    Route::get('/edit-users/{edit_id}', ['as' => 'edit-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@editUsers']);
    Route::post('/update-users', ['as' => 'update-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@update']);
    Route::post('/delete-users', ['as' => 'delete-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@delete']);
    Route::post('/show-users', ['as' => 'show-users', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@show']);
    Route::get('/cities', ['as' => 'cities', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getCities']);
    Route::get('/states', ['as' => 'states', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getState']);
    Route::get('/check-email-exists', ['as' => 'check-email-exists', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@checkEmailExists']);
    Route::get('/check-aadhar-exists', ['as' => 'check-aadhar-exists', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@checkAadharExists']);

    Route::get('/district', ['as' => 'district', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getDistrict']);
    Route::get('/taluka', ['as' => 'taluka', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getTaluka']);
    Route::get('/village', ['as' => 'village', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getVillage']);


    Route::get('/list-gramsevak', ['as' => 'list-gramsevak', 'uses' => 'App\Http\Controllers\Admin\Gramsevak\GramsevakController@index']);
    Route::post('/show-gramsevak-doc', ['as' => 'show-gramsevak-doc', 'uses' => 'App\Http\Controllers\Admin\Gramsevak\GramsevakController@showGramsevakDocuments']);
    Route::get('/update-gram-document-status', ['as' => 'update-gram-document-status', 'uses' => 'App\Http\Controllers\Admin\Gramsevak\GramsevakController@updateGramDocumentStatus']);
    Route::get('/list-grampanchayat-doc', ['as' => 'list-grampanchayat-doc', 'uses' => 'App\Http\Controllers\Admin\Gramsevak\GramsevakController@ListGrampanchayatDocuments']);


    Route::get('/get-location-wise-project', ['as' => 'get-location-wise-project', 'uses' => 'App\Http\Controllers\Admin\Reports\LaboursController@getLocationWiseProjects']);



    Route::post('/update-active-user', ['as' => 'update-active-user', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@updateOne']);
    // Route::get('/prof', ['as' => 'prof', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@getProf']);

    Route::get('/edit-user-profile', ['as' => 'edit-user-profile', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@editUsersProfile']);

    Route::post('/update-user-profile', ['as' => 'update-user-profile', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@updateProfile']);

    Route::post('/otp-verification', ['as' => 'otp-verification', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\RegisterController@updateEmailOtp']);

   
//=====Roles Route======
Route::get('/list-role', ['as' => 'list-role', 'uses' => 'App\Http\Controllers\Admin\Menu\RoleController@index']);
Route::get('/add-role', ['as' => 'add-role', 'uses' => 'App\Http\Controllers\Admin\Menu\RoleController@add']);
Route::post('/add-role', ['as' => 'add-role', 'uses' => 'App\Http\Controllers\Admin\Menu\RoleController@store']);
Route::get('/edit-role/{edit_id}', ['as' => 'edit-role', 'uses' => 'App\Http\Controllers\Admin\Menu\RoleController@edit']);
Route::post('/update-role', ['as' => 'update-role','uses' => 'App\Http\Controllers\Admin\Menu\RoleController@update']);
Route::post('/show-role', ['as' => 'show-role', 'uses' => 'App\Http\Controllers\Admin\Menu\RoleController@show']);
Route::post('/delete-role', ['as' => 'delete-role', 'uses' => 'App\Http\Controllers\Admin\Menu\RoleController@destroy']);
Route::post('/update-one-role', ['as' => 'update-one-role', 'uses' => 'App\Http\Controllers\Admin\Menu\RoleController@updateOneRole']);
Route::post('/list-role-wise-permission', ['as' => 'list-role-wise-permission', 'uses' => 'App\Http\Controllers\Admin\Menu\RoleController@listRoleWisePermission']);


Route::get('/list-gender', ['as' => 'list-gender', 'uses' => 'App\Http\Controllers\Admin\Master\GenderController@index']);
Route::get('/add-gender', ['as' => 'add-gender', 'uses' => 'App\Http\Controllers\Admin\Master\GenderController@add']);
Route::post('/add-gender', ['as' => 'add-gender', 'uses' => 'App\Http\Controllers\Admin\Master\GenderController@store']);
Route::get('/edit-gender/{edit_id}', ['as' => 'edit-gender', 'uses' => 'App\Http\Controllers\Admin\Master\GenderController@edit']);
Route::post('/update-gender', ['as' => 'update-gender', 'uses' => 'App\Http\Controllers\Admin\Master\GenderController@update']);
Route::post('/show-gender', ['as' => 'show-gender', 'uses' => 'App\Http\Controllers\Admin\Master\GenderController@show']);
Route::post('/delete-gender', ['as' => 'delete-gender', 'uses' => 'App\Http\Controllers\Admin\Master\GenderController@destroy']);
Route::post('/update-one-gender', ['as' => 'update-one-gender', 'uses' => 'App\Http\Controllers\Admin\Master\GenderController@updateOne']);

Route::get('/list-maritalstatus', ['as' => 'list-maritalstatus', 'uses' => 'App\Http\Controllers\Admin\Master\MaritalstatusController@index']);
Route::get('/add-maritalstatus', ['as' => 'add-maritalstatus', 'uses' => 'App\Http\Controllers\Admin\Master\MaritalstatusController@add']);
Route::post('/add-maritalstatus', ['as' => 'add-maritalstatus', 'uses' => 'App\Http\Controllers\Admin\Master\MaritalstatusController@store']);
Route::get('/edit-maritalstatus/{edit_id}', ['as' => 'edit-maritalstatus', 'uses' => 'App\Http\Controllers\Admin\Master\MaritalstatusController@edit']);
Route::post('/update-maritalstatus', ['as' => 'update-maritalstatus', 'uses' => 'App\Http\Controllers\Admin\Master\MaritalstatusController@update']);
Route::post('/show-maritalstatus', ['as' => 'show-maritalstatus', 'uses' => 'App\Http\Controllers\Admin\Master\MaritalstatusController@show']);
Route::post('/delete-maritalstatus', ['as' => 'delete-maritalstatus', 'uses' => 'App\Http\Controllers\Admin\Master\MaritalstatusController@destroy']);
Route::post('/update-one-maritalstatus', ['as' => 'update-one-maritalstatus', 'uses' => 'App\Http\Controllers\Admin\Master\MaritalstatusController@updateOne']);

Route::get('/list-relation', ['as' => 'list-relation', 'uses' => 'App\Http\Controllers\Admin\Master\RelationController@index']);
Route::get('/add-relation', ['as' => 'add-relation', 'uses' => 'App\Http\Controllers\Admin\Master\RelationController@add']);
Route::post('/add-relation', ['as' => 'add-relation', 'uses' => 'App\Http\Controllers\Admin\Master\RelationController@store']);
Route::get('/edit-relation/{edit_id}', ['as' => 'edit-relation', 'uses' => 'App\Http\Controllers\Admin\Master\RelationController@edit']);
Route::post('/update-relation', ['as' => 'update-relation', 'uses' => 'App\Http\Controllers\Admin\Master\RelationController@update']);
Route::post('/show-relation', ['as' => 'show-relation', 'uses' => 'App\Http\Controllers\Admin\Master\RelationController@show']);
Route::post('/delete-relation', ['as' => 'delete-relation', 'uses' => 'App\Http\Controllers\Admin\Master\RelationController@destroy']);
Route::post('/update-one-relation', ['as' => 'update-one-relation', 'uses' => 'App\Http\Controllers\Admin\Master\RelationController@updateOne']);

Route::get('/list-skills', ['as' => 'list-skills', 'uses' => 'App\Http\Controllers\Admin\Master\SkillsController@index']);
Route::get('/add-skills', ['as' => 'add-skills', 'uses' => 'App\Http\Controllers\Admin\Master\SkillsController@add']);
Route::post('/add-skills', ['as' => 'add-skills', 'uses' => 'App\Http\Controllers\Admin\Master\SkillsController@store']);
Route::get('/edit-skills/{edit_id}', ['as' => 'edit-skills', 'uses' => 'App\Http\Controllers\Admin\Master\SkillsController@edit']);
Route::post('/update-skills', ['as' => 'update-skills', 'uses' => 'App\Http\Controllers\Admin\Master\SkillsController@update']);
Route::post('/show-skills', ['as' => 'show-skills', 'uses' => 'App\Http\Controllers\Admin\Master\SkillsController@show']);
Route::post('/delete-skills', ['as' => 'delete-skills', 'uses' => 'App\Http\Controllers\Admin\Master\SkillsController@destroy']);
Route::post('/update-one-skills', ['as' => 'update-one-skills', 'uses' => 'App\Http\Controllers\Admin\Master\SkillsController@updateOne']);

Route::get('/list-registrationstatus', ['as' => 'list-registrationstatus', 'uses' => 'App\Http\Controllers\Admin\Master\RegistrationstatusController@index']);
Route::get('/add-registrationstatus', ['as' => 'add-registrationstatus', 'uses' => 'App\Http\Controllers\Admin\Master\RegistrationstatusController@add']);
Route::post('/add-registrationstatus', ['as' => 'add-registrationstatus', 'uses' => 'App\Http\Controllers\Admin\Master\RegistrationstatusController@store']);
Route::get('/edit-registrationstatus/{edit_id}', ['as' => 'edit-registrationstatus', 'uses' => 'App\Http\Controllers\Admin\Master\RegistrationstatusController@edit']);
Route::post('/update-registrationstatus', ['as' => 'update-registrationstatus', 'uses' => 'App\Http\Controllers\Admin\Master\RegistrationstatusController@update']);
Route::post('/show-registrationstatus', ['as' => 'show-registrationstatus', 'uses' => 'App\Http\Controllers\Admin\Master\RegistrationstatusController@show']);
Route::post('/delete-registrationstatus', ['as' => 'delete-registrationstatus', 'uses' => 'App\Http\Controllers\Admin\Master\RegistrationstatusController@destroy']);
Route::post('/update-one-registrationstatus', ['as' => 'update-one-registrationstatus', 'uses' => 'App\Http\Controllers\Admin\Master\RegistrationstatusController@updateOne']);

Route::get('/list-documenttype', ['as' => 'list-documenttype', 'uses' => 'App\Http\Controllers\Admin\Master\DocumenttypeController@index']);
Route::get('/add-documenttype', ['as' => 'add-documenttype', 'uses' => 'App\Http\Controllers\Admin\Master\DocumenttypeController@add']);
Route::post('/add-documenttype', ['as' => 'add-documenttype', 'uses' => 'App\Http\Controllers\Admin\Master\DocumenttypeController@store']);
Route::get('/edit-documenttype/{edit_id}', ['as' => 'edit-documenttype', 'uses' => 'App\Http\Controllers\Admin\Master\DocumenttypeController@edit']);
Route::post('/update-documenttype', ['as' => 'update-documenttype', 'uses' => 'App\Http\Controllers\Admin\Master\DocumenttypeController@update']);
Route::post('/show-documenttype', ['as' => 'show-documenttype', 'uses' => 'App\Http\Controllers\Admin\Master\DocumenttypeController@show']);
Route::post('/delete-documenttype', ['as' => 'delete-documenttype', 'uses' => 'App\Http\Controllers\Admin\Master\DocumenttypeController@destroy']);
Route::post('/update-one-documenttype', ['as' => 'update-one-documenttype', 'uses' => 'App\Http\Controllers\Admin\Master\DocumenttypeController@updateOne']);

Route::get('/list-usertype', ['as' => 'list-usertype', 'uses' => 'App\Http\Controllers\Admin\Master\UsertypeController@index']);
Route::get('/add-usertype', ['as' => 'add-usertype', 'uses' => 'App\Http\Controllers\Admin\Master\UsertypeController@add']);
Route::post('/add-usertype', ['as' => 'add-usertype', 'uses' => 'App\Http\Controllers\Admin\Master\UsertypeController@store']);
Route::get('/edit-usertype/{edit_id}', ['as' => 'edit-usertype', 'uses' => 'App\Http\Controllers\Admin\Master\UsertypeController@edit']);
Route::post('/update-usertype', ['as' => 'update-usertype', 'uses' => 'App\Http\Controllers\Admin\Master\UsertypeController@update']);
Route::post('/show-usertype', ['as' => 'show-usertype', 'uses' => 'App\Http\Controllers\Admin\Master\UsertypeController@show']);
Route::post('/delete-usertype', ['as' => 'delete-usertype', 'uses' => 'App\Http\Controllers\Admin\Master\UsertypeController@destroy']);
Route::post('/update-one-usertype', ['as' => 'update-one-usertype', 'uses' => 'App\Http\Controllers\Admin\Master\UsertypeController@updateOne']);


// Reports======================
Route::get('/list-location-report', ['as' => 'list-location-report', 'uses' => 'App\Http\Controllers\Admin\Reports\ReportsController@getAllLabourLocation']);
Route::get('/list-labour-duration-report', ['as' => 'list-labour-duration-report', 'uses' => 'App\Http\Controllers\Admin\Reports\ReportsController@getAllLabourDuration']);
Route::get('/list-project-report', ['as' => 'list-project-report', 'uses' => 'App\Http\Controllers\Admin\Reports\ReportsController@getAllProjects']);
Route::get('/list-project-and-location-report', ['as' => 'list-project-and-location-report', 'uses' => 'App\Http\Controllers\Admin\Reports\ReportsController@getAllProjectLocation']);

Route::get('/list-labours-filter-reports', ['as' => 'list-labours-filter-reports', 'uses' => 'App\Http\Controllers\Admin\Reports\ReportsController@getFilterLaboursReport']);
Route::get('/list-project-wise-labour-reports', ['as' => 'list-project-wise-labour-reports', 'uses' => 'App\Http\Controllers\Admin\Reports\ReportsController@getFilterProjectsReport']);

// Route::get('/db-backup', ['as' => 'db-backup', 'uses' => 'App\Http\Controllers\DBBackup\DBBackupController@downloadBackup']);

// routes for tablet watap
Route::get('/log-out', ['as' => 'log-out', 'uses' => 'App\Http\Controllers\Admin\LoginRegister\LoginController@logout']);

Route::get('/list-district', ['as' => 'list-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@index']);
Route::get('/add-district', ['as' => 'add-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addDistrict']);
Route::post('/add-district', ['as' => 'add-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addDistrictInsert']);
Route::post('/update-active-dist', ['as' => 'update-active-dist', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateOneDistrict']);
Route::get('/edit-district/{edit_id}', ['as' => 'edit-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@editDistrict']);
Route::post('/update-district', ['as' => 'update-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateDistrict']);
Route::post('/delete-district', ['as' => 'delete-district', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@deleteDistrict']);




Route::get('/list-taluka', ['as' => 'list-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@getTalukaList']);
Route::get('/add-taluka', ['as' => 'add-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addTaluka']);
Route::post('/add-taluka', ['as' => 'add-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addTalukaInsert']);
Route::post('/update-active-taluka', ['as' => 'update-active-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateOneTaluka']);
Route::get('/edit-taluka/{edit_id}', ['as' => 'edit-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@editTaluka']);
Route::post('/update-taluka', ['as' => 'update-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateTaluka']);
Route::post('/delete-taluka', ['as' => 'delete-taluka', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@deleteTaluka']);



Route::get('/list-village', ['as' => 'list-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@getVillageList']);
Route::get('/add-village', ['as' => 'add-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addVillage']);
Route::post('/add-village', ['as' => 'add-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@addVillageInsert']);
Route::post('/update-active-village', ['as' => 'update-active-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateOneVillage']);
Route::get('/edit-village/{edit_id}', ['as' => 'edit-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@editVillage']);
Route::post('/update-village', ['as' => 'update-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@updateVillage']);
Route::post('/delete-village', ['as' => 'delete-village', 'uses' => 'App\Http\Controllers\Admin\Area\AreaController@deleteVillage']);


Route::get('/list-gramsevak-tablet-distribution', ['as' => 'list-gramsevak-tablet-distribution', 'uses' => 'App\Http\Controllers\Admin\TabletDistribution\TabletDistributionController@index']);
Route::post('/show-tablet-distribution', ['as' => 'show-tablet-distribution', 'uses' => 'App\Http\Controllers\Admin\TabletDistribution\TabletDistributionController@showTabletDistribution']);
Route::get('/filter-tablet-distribution', ['as' => 'filter-tablet-distribution', 'uses' => 'App\Http\Controllers\Admin\TabletDistribution\TabletDistributionController@getFilterTabletDistribution']);
Route::get('/list-distributer-baneficiary/{edit_id}', ['as' => 'list-distributer-baneficiary', 'uses' => 'App\Http\Controllers\Admin\TabletDistribution\TabletDistributionController@getDistributerBenificiaryList']);
Route::post('/show-distributer-baneficiary-details', ['as' => 'show-distributer-baneficiary-details', 'uses' => 'App\Http\Controllers\Admin\TabletDistribution\TabletDistributionController@showDistributiorBenificiaryDetails']);
Route::get('/filter-tablet-distribution-all', ['as' => 'filter-tablet-distribution-all', 'uses' => 'App\Http\Controllers\Admin\TabletDistribution\TabletDistributionController@getFilterTabletDistributionAll']);


Route::post('/filter-tablet-distribution-all-export', ['as' => 'filter-tablet-distribution-all-export', 'uses' => 'App\Http\Controllers\Admin\TabletDistribution\TabletDistributionController@getFilterTabletDistributionAllExport']);
Route::post('/filter-tablet-distributer-baneficiary-export', ['as' => 'filter-tablet-distributer-baneficiary-export', 'uses' => 'App\Http\Controllers\Admin\TabletDistribution\TabletDistributionController@getFilterTabletDistributerBeneficiaryExport']);





});

});
});