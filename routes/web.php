<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product-list', [App\Http\Controllers\ProductController::class, 'index'])->name('product.list');
Route::get('/product-create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::post('/product-store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::get('/product-show/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
//Route::post('/{id}/product-edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('/product-update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::delete('/product-delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');
