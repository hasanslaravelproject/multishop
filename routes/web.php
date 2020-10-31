<?php

use Illuminate\Support\Facades\Mail;
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

Route::get('/', [\App\Http\Controllers\FrontController::class, 'index']);
/* Route::get('admin', function () {
     return view('dashboard.admin');
});
Route::get('superadmin', function () {
    return view('dashboard.super-admin');
});*/
Route::get('login', function () {
    return view('login');
});

Route::get('test', function () {

    $user = [
        'name' => 'Mahedi Hasan',
        'info' => 'Laravel Developer'
    ];

    Mail::to('hasanslaravelproject@gmail.com')->send(new \App\Mail\JustTesting($user));

    dd("success");

});


Route::post('login', [\App\Http\Controllers\AdminController::class, 'login']);
Route::get('logout', [\App\Http\Controllers\AdminController::class, 'logout']);
Route::get('enter-store/{id}', [\App\Http\Controllers\FrontController::class, 'viewstore']);
Route::get('subscribe/{id}', [\App\Http\Controllers\FrontController::class, 'subscribe']);
Route::get('payment/{price}', [\App\Http\Controllers\FrontController::class, 'ProductPayment']);
Route::get('stripe', [\App\Http\Controllers\StripePaymentController::class, 'stripe']);
Route::post('stripe', [\App\Http\Controllers\StripePaymentController::class, 'stripePost'])->name('stripe.post');

Route::post('client-reg', [\App\Http\Controllers\FrontController::class, 'clientReg']);
Route::get('add-to-cart/{id}', [\App\Http\Controllers\FrontController::class, 'addToCart']);
Route::get('cart', [\App\Http\Controllers\FrontController::class, 'cart']);
//Category
Route::get('category', [\App\Http\Controllers\CategoryController::class, 'index']);
Route::post('category/add', [\App\Http\Controllers\CategoryController::class, 'create']);
Route::post('category/update', [\App\Http\Controllers\CategoryController::class, 'update']);
Route::get('category/status/{id}', [\App\Http\Controllers\CategoryController::class, 'status']);
Route::get('category/get/{id}', [\App\Http\Controllers\CategoryController::class, 'getcategory']);
Route::get('category/delete/{id}', [\App\Http\Controllers\CategoryController::class, 'delete']);
//Product
Route::get('product', [\App\Http\Controllers\ProductController::class, 'index']);
Route::post('product/add', [\App\Http\Controllers\ProductController::class, 'create']);
Route::post('product/update', [\App\Http\Controllers\ProductController::class, 'update']);
Route::get('product/status/{id}', [\App\Http\Controllers\ProductController::class, 'status']);
Route::get('product/get/{id}', [\App\Http\Controllers\ProductController::class, 'getproduct']);
Route::get('product/delete/{id}', [\App\Http\Controllers\ProductController::class, 'delete']);
//Package
Route::get('package', [\App\Http\Controllers\PackageController::class, 'index']);
Route::post('package/add', [\App\Http\Controllers\PackageController::class, 'create']);
Route::post('package/update', [\App\Http\Controllers\PackageController::class, 'update']);
Route::get('package/status/{id}', [\App\Http\Controllers\PackageController::class, 'status']);
Route::get('package/get/{id}', [\App\Http\Controllers\PackageController::class, 'getpackage']);
Route::get('package/delete/{id}', [\App\Http\Controllers\PackageController::class, 'delete']);
//Store
Route::get('store', [\App\Http\Controllers\StoreController::class, 'index']);
Route::post('store/add', [\App\Http\Controllers\StoreController::class, 'create']);
Route::post('store/update', [\App\Http\Controllers\StoreController::class, 'update']);
Route::get('store/status/{id}', [\App\Http\Controllers\StoreController::class, 'status']);
Route::get('store/get/{id}', [\App\Http\Controllers\StoreController::class, 'getstore']);
Route::get('store/delete/{id}', [\App\Http\Controllers\StoreController::class, 'delete']);
