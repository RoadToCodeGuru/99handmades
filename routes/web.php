<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

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
    return redirect('/item');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('admin.items.index');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('item', [ItemController::class, 'index']);
    Route::get('item/{id}', [ItemController::class, 'edit']);
    Route::post('create_item', [ItemController::class, 'store']);
    Route::post('delete_item', [ItemController::class, 'destroy']);

    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/{id}', [CategoryController::class, 'edit']);
    Route::post('create_category', [CategoryController::class, 'store']);
    Route::post('delete_category', [CategoryController::class, 'destroy']);

    Route::get('subcategory', [SubCategoryController::class, 'index']);
    Route::get('subcategory/{id}', [SubCategoryController::class, 'edit']);
    Route::post('create_subcategory', [SubCategoryController::class, 'store']);
    Route::post('delete_subcategory', [SubCategoryController::class, 'destroy']);
});
