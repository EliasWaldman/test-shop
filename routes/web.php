<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
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



Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/groups/{group}', [CatalogController::class, 'show'])->name('catalog.show');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
