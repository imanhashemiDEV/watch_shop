<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->namespace('Api\V1')->middleware('auth:sanctum')->group(function () {

    // register user name and address
    Route::post('register', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'register']);

    //    user profile
    Route::post('profile', [\App\Http\Controllers\Api\V1\UserApiController::class, 'profile']);

    // get user addresses
    Route::post('user_addresses', [\App\Http\Controllers\Api\V1\UserApiController::class, 'userAddresses']);

    // payment
    Route::post('payment',[\App\Http\Controllers\Api\V1\PaymentController::class,'payment'])->name('save.payment');

    // save product comment
    Route::post('save_product_comment', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'saveComment']);

});


Route::prefix('/v1')->namespace('Api\V1')->group(function () {

    // Send sms  to verify user
    Route::post('send_sms', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'sendSms']);

    // check recieved sms
    Route::post('check_sms_code', [\App\Http\Controllers\Api\V1\AuthApiController::class, 'checkSmsCode']);

    // get home page
    Route::get('home', [\App\Http\Controllers\Api\V1\HomePageApiController::class, 'home']);

    // get all products
    Route::get('all_products', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'allProducts']);

    // get newest products
    Route::get('newestl_products', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'newestProducts']);

    // get most expensive products
    Route::get('most_expensive_products', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'mostExpensiveProducts']);

    // get most viewed products
    Route::get('most_viewed_products', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'mostViewedProducts']);

    // get cheapest products
    Route::get('cheapest_products', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'cheapestProducts']);

    // get products by category
    Route::get('products_by_category/{id}', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'productsByCategory']);

    // get products by brand
    Route::get('products_by_brand/{id}', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'productsByBrand']);

    // get product details
    Route::get('product_details/{id}', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'productDetail']);

    // payment callback
    Route::get('payment/callback',[\App\Http\Controllers\Api\V1\PaymentController::class,'callback']);

    // search product
    Route::post('search_product', [\App\Http\Controllers\Api\V1\ProductPageApiController::class, 'searchProduct']);
});
