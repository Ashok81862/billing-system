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

    Route::put('/{order}/customers/assign', [\App\Http\Controllers\Admin\OrderController::class, 'assignCustomer'])->name('orders.customers.assign');
        Route::put('/{order}/customers/create', [\App\Http\Controllers\Admin\OrderController::class, 'createCustomerAndAssign'])->name('orders.customers.create');
        Route::put('/{order}/customers/remove', [\App\Http\Controllers\Admin\OrderController::class, 'removeCustomer'])->name('orders.customers.remove');

        Route::put('/{order}/add', [\App\Http\Controllers\Admin\OrderController::class, 'addProduct'])->name('orders.add');
        Route::delete('/{order}/{orderProduct}/remove', [\App\Http\Controllers\Admin\OrderController::class, 'removeProduct'])->name('orders.remove');
        Route::put('/{order}/quantity', [\App\Http\Controllers\Admin\OrderController::class, 'updateQuantity'])->name('orders.quantity');
        Route::put('/{order}/discount', [\App\Http\Controllers\Admin\OrderController::class, 'discount'])->name('orders.discount');
        Route::put('/{order}/final', [\App\Http\Controllers\Admin\OrderController::class, 'final'])->name('orders.final');

        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);

        Route::resource('stocks', \App\Http\Controllers\Admin\StockController::class);

        Route::resource('vendors', \App\Http\Controllers\Admin\VendorController::class);

        Route::resource('sales', \App\Http\Controllers\Admin\SaleController::class);

        Route::put('batches/{batch}/products', [\App\Http\Controllers\Admin\BatchController::class,'addProduct'])->name('batches.products.store');
        Route::delete('batches/{batch}/products', [\App\Http\Controllers\Admin\BatchController::class,'removeProduct'])->name('batches.products.remove');

        Route::resource('batches', \App\Http\Controllers\Admin\BatchController::class);
});
