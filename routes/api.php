<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/employee-list', [EmployeeController::class, 'showEmployeeList']);
Route::get('/employee-list/{id}', [EmployeeController::class, 'showEditProfileForm']);
Route::post('/add-new-employee', [EmployeeController::class, 'submitCreateEmployeeForm']);
Route::post('/edit-employee/{id}', [EmployeeController::class, 'submitEditProfileForm']);
Route::post('/delete-employee/{id}', [EmployeeController::class, 'deleteEmployee']);
Route::get('/download-employee', [EmployeeController::class, 'downloadEmployeeList']);
Route::get('/show-profile/{id}', [EmployeeController::class, 'showEmployeeProfile']);
Route::post('/import', [EmployeeController::class, 'importEmployeeList']);
Route::get('/get-password/{id}', [EmployeeController::class, 'getOldPassword']);
