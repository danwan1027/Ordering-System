<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/direct', [App\Http\Controllers\HomeController::class, 'direct']);

//group
Route::group(['middleware' => 'auth'], function(){

    Route::get('/changePassword', [App\Http\Controllers\HomeController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword', [App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('changePasswordPost');
    
    //Manager
    Route::group(['middleware' => 'isManager'], function(){
        Route::get('/manager', [App\Http\Controllers\ManagerController::class, 'index']);
        Route::get('/manager/createProduct', [App\Http\Controllers\ManagerController::class, 'createProduct_page']);
        Route::get('/manager/createAdmin', [App\Http\Controllers\ManagerController::class, 'createAdmin_page']);
        Route::get('/manager/editProduct', [App\Http\Controllers\ManagerController::class, 'editProduct_page']);

        Route::post('/createProduct', [App\Http\Controllers\ProductController::class, 'create']);
        Route::get('/editInput/{id}', [App\Http\Controllers\ManagerController::class, 'editInput']);
        Route::post('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit']);
        Route::post('/createAdmin', [App\Http\Controllers\ManagerController::class, 'createAdmin']);
        Route::get('/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete']);
    });

    //Admin
    Route::group(['middleware' => 'isAdmin'], function(){
        Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
        Route::get('/admin/updateToReceiving/{id}', [App\Http\Controllers\OrderController::class, 'update_to_receiving']);
        Route::get('/admin/updateToDone/{id}', [App\Http\Controllers\OrderController::class, 'update_to_done']);
    });

    //User
    Route::group(['middleware' => 'isUser'], function(){
        Route::get('/progress', [App\Http\Controllers\UserController::class, 'progress']);
        Route::get('/cart', [App\Http\Controllers\UserController::class, 'cart']);
        Route::get('/history', [App\Http\Controllers\UserController::class, 'history']);
        Route::post('/addToCart', [App\Http\Controllers\ItemController::class, 'create']);
        Route::post('/createOrder', [App\Http\Controllers\OrderController::class, 'create']);
        Route::get('/deleteItem/{id}', [App\Http\Controllers\ItemController::class, 'delete']);
        // Route::post('/createOrder', [App\Http\Controllers\OrderController::class, 'create_and_add_popularity']);
        // Route::post('/toMaking', [App\Http\Controllers\OrderController::class, 'update_to_making']);
    });


});


