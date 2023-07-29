<?php

use App\Http\Controllers\AttendanceLeaveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupPoliciesController;
use App\Http\Controllers\PenaltyConditionController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\WorkPlaceController;
use Illuminate\Support\Facades\Route;

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


Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
    Route::post('refresh', 'refresh')->middleware('auth:sanctum');
    Route::get('/', 'user')->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->prefix('requests')->group(function () {
    Route::controller(RequestController::class)->group(function () {
        Route::post('/create', 'store');
        Route::get('/', 'index');
        Route::get('/{request}', 'show');
        Route::patch('/{requestModel?}', 'update');
    });

});

Route::middleware('auth:sanctum')->prefix('attendance-leaves')->group(function () {
    Route::controller(AttendanceLeaveController::class)->group(function () {
        Route::post('/create', 'store');
        Route::get('/', 'index');
        Route::get('/user', 'index');
    });
});
Route::middleware('auth:sanctum')->prefix('work-places')->group(function () {
    Route::controller(WorkPlaceController::class)->group(function () {
        Route::post('/create', 'store');
        Route::get('/', 'index');
    });
});
Route::middleware('auth:sanctum')->prefix('group-policies')->group(function () {
    Route::controller(GroupPoliciesController::class)->group(function () {
        Route::post('/create', 'store');
        Route::get('/', 'index');
    });
});
Route::middleware('auth:sanctum')->prefix('penalty-conditions')->group(function () {
    Route::controller(PenaltyConditionController::class)->group(function () {
        Route::post('/create', 'store');
    });
});
