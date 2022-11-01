<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/edit-category',[AdminController::class,'editCategory']);
Route::get('/add-category',[AdminController::class,'addCategory']);
Route::get('/table-category',[AdminController::class,'tableCategory']);
Route::get('/edit-product',[AdminController::class,'editProduct']);
Route::get('/add-product',[AdminController::class,'addProduct']);
Route::get('/table-product',[AdminController::class,'tableProduct']);
Route::get('/admin-index',[AdminController::class,'index']);

Route::get('/',[HomeController::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
