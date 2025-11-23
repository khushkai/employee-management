<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\EmployeeApiController;

Route::get('/test', function() {
    return ['status' => 'api working'];
});

Route::post('/token', [AuthApiController::class,'token']);

Route::middleware('jwt.auth')->group(function(){

    Route::get('/employees', [EmployeeApiController::class,'index']);
    Route::post('/employees', [EmployeeApiController::class,'store']);
    Route::get('/employees/{id}', [EmployeeApiController::class,'show']);
    Route::put('/employees/{id}', [EmployeeApiController::class,'update']);
    Route::delete('/employees/{id}', [EmployeeApiController::class,'destroy']);
});

