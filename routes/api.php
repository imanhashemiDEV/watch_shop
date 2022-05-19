<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->namespace('Api\V1')->middleware('auth:sanctum')->group(function () {

    //    User Info
    Route::post('user_info', [\App\Http\Controllers\Api\V1\UserApiController::class, 'user_info']);
});


Route::prefix('/v1')->namespace('Api\V1')->group(function () {

    //auth
    Route::post('test', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'test']);


    Route::post('send_sms', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'sendSms']);
    Route::post('check_sms_code', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'checkSmsCode']);
    Route::post('register', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'register']);
    Route::get('home_page', [\App\Http\Controllers\Api\V1\HomePageApiController::class, 'homePage']);
    Route::get('products_page', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'productsPage']);

});
