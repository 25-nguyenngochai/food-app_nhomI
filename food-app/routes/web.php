<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

// Page Admin:
Route::group(['middleware' => ['CheckLogin']], function () {
    // Table Category:
    Route::get('delete-category/{id}',[AdminController::class,'getDelCategory'])->name('get_delete-category');
    Route::post('edit-category/{id}',[AdminController::class,'postEditCategory'])->name('post_edit-category');
    Route::get('edit-category/{id}',[AdminController::class,'getEditCategory'])->name('get_edit-category');   
    Route::post('add-category',[AdminController::class,'postAddCategory'])->name('add_catalog');
    Route::get('add-category',[AdminController::class,'getAddCategory']);
    Route::get('table-category',[AdminController::class,'tableCategory']);
    // Table Product:
    Route::get('/edit-product',[AdminController::class,'editProduct']);
    Route::get('/add-product',[AdminController::class,'addProduct']);
    Route::get('table-product',[AdminController::class,'tableProduct']);
    // Page Index:
    Route::get('admin-index',[AdminController::class,'index']);
});

// Page Home:
Route::get('contact',[HomeController::class,'contact']);
Route::post('checkcart',[HomeController::class,'PostCheckout'])->name('checkcart');
Route::get('checkout',[HomeController::class,'checkout']);
Route::get('thanks',[HomeController::class,'thanks']);
Route::post('update_wishlist',[HomeController::class,'updateWishlist']);
Route::get('favourite',[HomeController::class,'favourite']);
Route::get('delcartone/{id}',[HomeController::class,'getDelCartOne'])->name('delcartone');
Route::get('delcart/{id}',[HomeController::class,'getDelCart'])->name('delCart');
Route::get('addcart/{id}',[HomeController::class,'getAddCart'])->name('addCart');
Route::get('shoping-cart',[HomeController::class,'shopingCart']);
Route::get('shop-details',[HomeController::class,'shopDetails']);
Route::get('shop-grid',[HomeController::class,'shopGrid']);
Route::get('my-seach',[HomeController::class,'my_seach']);
Route::get('/',[CheckController::class,'checkUserType']);
Route::get('index',[HomeController::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';