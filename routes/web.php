<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/upload', [ProductController::class, 'showForm']);
Route::post('/upload', [ProductController::class, 'upload']);
Route::get('/products', [ProductController::class, 'showProducts']);
Route::get('/products/{id}', [ProductController::class, 'showProductById']);
