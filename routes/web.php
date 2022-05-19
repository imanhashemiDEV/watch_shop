<?php

use Illuminate\Support\Facades\Route;


// Front routes
Route::get('/', function () {return view('front.home');})->name('home');
Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

//Admin routes
Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'admin'])->group(function (){

    Route::get('/',[\App\Http\Controllers\Admin\PanelController::class,'index'])->name('admin.panel');
    Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/sliders', \App\Http\Controllers\Admin\SliderController::class);
    Route::resource('/brands', \App\Http\Controllers\Admin\BrandController::class);
    Route::resource('/products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('/properties', \App\Http\Controllers\Admin\PropertyController::class);
    Route::resource('/property_group', \App\Http\Controllers\Admin\PropertyGroupController::class);
    Route::resource('/colors', \App\Http\Controllers\Admin\ColorController::class);
    Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);
    Route::get('/create_user_roles/{id}',[\App\Http\Controllers\Admin\UserController::class,'createUserRoles'])->name('create.user.roles');
    Route::post('/store_user_roles/{id}',[\App\Http\Controllers\Admin\UserController::class,'storeUserRoles'])->name('store.user.roles');
    Route::resource('/roles',\App\Http\Controllers\Admin\RoleController::class);
    Route::get('/create_role_permissions/{id}',[\App\Http\Controllers\Admin\RoleController::class,'createRolePermission'])->name('create.role.permission');
    Route::post('/store_role_permissions/{id}',[\App\Http\Controllers\Admin\RoleController::class,'storeRolePermission'])->name('store.role.permission');
    Route::resource('/permissions',\App\Http\Controllers\Admin\PermissionController::class);
    Route::resource('/tags',\App\Http\Controllers\Admin\TagController::class);
    Route::get('/logs', [\App\Http\Controllers\Admin\LogViewerController::class,'index'])->name('logs.index');
    Route::resource('/galleries',\App\Http\Controllers\Admin\GalleryController::class);
    Route::get('/comments',[\App\Http\Controllers\Admin\CommentController::class,'index'])->name('comments.index');
    Route::delete('/comments/{id}',[\App\Http\Controllers\Admin\CommentController::class,'destroy'])->name('comment.destroy');
    Route::patch('/comments/{id}',[\App\Http\Controllers\Admin\CommentController::class,'update'])->name('comment.update');


});

