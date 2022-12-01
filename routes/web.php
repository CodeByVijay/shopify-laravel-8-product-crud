<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login', function () {
    if (Auth::user()) {
        return redirect()->route('home');
    }
    return view('login');
})->name('login');


Route::group(['middleware' => 'auth.shopify'], function () {
    // Route::get('/', function () {
    //     return view('welcome');
    // })->name('home');

    Route::get('/', [ProductController::class,'index'])->name('home');
    Route::get('product-delete/{id}',[ProductController::class,'productDelete'])->name('productDelete');
    Route::post('get-single-product',[ProductController::class,'getSingleProduct'])->name('getSingleProduct');
    Route::post('edit-single-product',[ProductController::class,'editSingleProduct'])->name('editSingleProduct');
    
});
