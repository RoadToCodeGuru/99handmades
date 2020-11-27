<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MakeSetController;
use App\Http\Controllers\ItemSetController;

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


Route::get('/invoice_test', function () {
    return view('invoice_test');
});

Route::get('/front_test', function () {
    return view('customer.content');
});

Route::get('/cart_test', function () {
    return view('customer.cart');
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

    Route::get('makeset', [MakeSetController::class, 'index']);
    Route::get('makeset/{id}', [MakeSetController::class, 'edit']);
    Route::post('create_makeset', [MakeSetController::class, 'store']);
    Route::post('delete_makeset', [MakeSetController::class, 'destroy']);

    Route::get('invoice', [MakeSetController::class, 'invoice']);
    Route::get('set_detail/{id}', [MakeSetController::class, 'set_detail']);

    Route::get('itemset', [ItemSetController::class, 'index']);
    Route::get('itemset/{id}', [ItemSetController::class, 'edit']);
    Route::post('create_itemset', [ItemSetController::class, 'store']);
    Route::post('edit_itemset', [ItemSetController::class, 'update']);
    Route::post('delete_itemset', [ItemSetController::class, 'destroy']);

    Route::post('import_itemset', [ItemSetController::class, 'import']);
    Route::post('empty_itemset', [ItemSetController::class, 'empty']);
});
