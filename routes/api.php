<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\TabletDistribution\GramSevakTabletDistributionController;
use App\Http\Controllers\Api\Master\AllMasterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/list-masters', [AllMasterController::class, 'getAllMasters']);
Route::post('/list-masters-updated', [AllMasterController::class, 'getAllMastersUpdated']);



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {


    // Protected routes that require authentication token
    Route::middleware('auth:api')->group(function () {
         //=============Start labour=================
        Route::post('/add-tablet-info', [GramSevakTabletDistributionController::class, 'add']);
        Route::post('/list-tablet-distribution-info', [GramSevakTabletDistributionController::class, 'getAllTabletDistributionList']);
        Route::post('/get-tablet-distribution-perticular-info', [GramSevakTabletDistributionController::class, 'getAllTabletDistributionViewPerticular']);
     
        Route::post('/update-labour-first-form', [GramSevakTabletDistributionController::class, 'updateLabourFirstForm']);
        Route::post('/adhar-card-exist', [GramSevakTabletDistributionController::class, 'adharCardExist']);
        
        Route::post('logout', [AuthController::class, 'logout']);
    });
});






