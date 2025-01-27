<?php

use App\Http\Controllers\CatalogController;
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
// Главная страница
Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');

// Страница группы
Route::get('/group/{id}', [CatalogController::class, 'group'])->name('catalog.group');

// Карточка товара
Route::get('/product/{id}', [CatalogController::class, 'product'])->name('catalog.product');
