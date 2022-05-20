<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->namespace('Api\V1')->middleware('auth:sanctum')->group(function () {

    //    User Info
    Route::post('profile', [\App\Http\Controllers\Api\V1\UserApiController::class, 'user_info']);

    // Payment

    // save product comment
    Route::post('save_product_comment', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'saveComment']);
});


Route::prefix('/v1')->namespace('Api\V1')->group(function () {

    // Send sms  to verify user
    Route::post('send_sms', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'sendSms']);

    // check recieved sms
    Route::post('check_sms_code', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'checkSmsCode']);

    // register user name and address
    Route::post('register', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'register']);

    // get home page info
    Route::get('home_page', [\App\Http\Controllers\Api\V1\HomePageApiController::class, 'homePage']);

    // get products page info
    Route::get('products_page', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'productsPage']);

    // get products by category
    Route::get('products_by_category/{id}', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'productsByCategory']);

    // get products by brand
    Route::get('products_by_brand/{id}', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'productsByBrand']);

    // get product details
    Route::get('product_details/{id}', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'productDetail']);
});
