<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->namespace('Api\V1')->middleware('auth:sanctum')->group(function () {

    //    User Info
    Route::post('user_info', [\App\Http\Controllers\Api\V1\UserController::class, 'user_info']);
});


Route::prefix('/v1')->namespace('Api\V1')->group(function () {

    //auth
    Route::post('send_sms', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'sendSms']);
    Route::post('check_sms_code', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'checkSmsCode']);
    Route::post('register', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'register']);
});
