<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->namespace('Api\V1')->middleware('auth:sanctum')->group(function () {

//    User Info
      Route::post('user_info_update', [\App\Http\Controllers\Api\V1\UserInfoController::class,'user_info_update']);
      Route::post('user_info', [\App\Http\Controllers\Api\V1\UserInfoController::class,'user_info']);
      Route::post('user_fcm_token', [\App\Http\Controllers\Api\V1\UserInfoController::class,'UserFCMToken']);



});


Route::prefix('/v1')->namespace('Api\V1')->group(function () {

//login
    Route::post('register', [\App\Http\Controllers\Api\V1\LoginApiController::class,'signInUser']);
   
});

