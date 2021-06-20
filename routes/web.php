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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home',[\App\Http\Controllers\SiteController::class, 'home'])->middleware('auth');

Route::middleware([ 'admin',])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index']);

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

    Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class);

    Route::resource('units', \App\Http\Controllers\Admin\UnitController::class);

    Route::resource('logistics', \App\Http\Controllers\Admin\LogisticController::class);

    Route::resource('employees', \App\Http\Controllers\Admin\EmployeeController::class);

    Route::resource('logisticTypes', \App\Http\Controllers\Admin\LogisticTypeController::class);

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
});
