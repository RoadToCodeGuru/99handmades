<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MakeSetController;
use App\Http\Controllers\ItemSetController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\OrderLogController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Customer\ContentController;

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

// Route::get('/', [ContentController::class, 'content']);

Route::get('/', function () {
    return redirect('/item');
});

Route::get('/invoice_test', function () {
    return view('invoice_test');
});


Route::get('/cart_test', function () {
    return view('customer.cart');
});

Route::get('/order_detail', function () {
    return view('admin.details.order_detail');
});
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('admin.items.index');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    //items
    Route::get('item', [ItemController::class, 'index']);
    Route::get('item/{id}', [ItemController::class, 'edit']);
    Route::post('create_item', [ItemController::class, 'store']);
    Route::post('delete_item', [ItemController::class, 'destroy']);

    //category  
    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/{id}', [CategoryController::class, 'edit']);
    Route::post('create_category', [CategoryController::class, 'store']);
    Route::post('delete_category', [CategoryController::class, 'destroy']);

    // subcategory
    Route::get('subcategory', [SubCategoryController::class, 'index']);
    Route::get('subcategory/{id}', [SubCategoryController::class, 'edit']);
    Route::post('create_subcategory', [SubCategoryController::class, 'store']);
    Route::post('delete_subcategory', [SubCategoryController::class, 'destroy']);

    // item_box
    Route::get('makeset', [MakeSetController::class, 'index']);
    Route::get('makeset/{id}', [MakeSetController::class, 'edit']);
    Route::post('create_makeset', [MakeSetController::class, 'store']);
    Route::post('delete_makeset', [MakeSetController::class, 'destroy']);

    Route::get('set_detail/{id}', [MakeSetController::class, 'set_detail']);

    // itemset
    Route::get('itemset', [ItemSetController::class, 'index']);
    Route::get('itemset/{id}', [ItemSetController::class, 'edit']);
    Route::post('create_itemset', [ItemSetController::class, 'store']);
    Route::post('edit_itemset', [ItemSetController::class, 'update']);
    Route::post('delete_itemset', [ItemSetController::class, 'destroy']);

    Route::post('import_itemset', [ItemSetController::class, 'import']);
    Route::post('empty_itemset', [ItemSetController::class, 'empty']);

    //customer
    Route::get('customers', [CustomerController::class, 'index']);
    Route::get('customers/{id}', [CustomerController::class, 'edit']);
    Route::post('create_customers', [CustomerController::class, 'store']);
    Route::post('delete_customers', [CustomerController::class, 'destroy']);

    //orders
    Route::get('order', [OrderListController::class, 'index']);
    Route::get('completed_sales', [OrderListController::class, 'sale']);
    Route::get('order/{id}', [OrderListController::class, 'edit']);
    Route::post('create_order', [OrderListController::class, 'store']);
    Route::post('delete_order', [OrderListController::class, 'destroy']);

    Route::get('detail_order/{id}', [OrderListController::class, 'detail']);
    Route::get('invoice_order/{id}', [OrderListController::class, 'invoice']);
    Route::get('phcover', [OrderListController::class, 'phcover']);

    //order_box
    Route::get('order_box', [OrderController::class, 'index']);
    Route::get('order_box/{id}', [OrderController::class, 'edit']);
    Route::post('create_order_box', [OrderController::class, 'store']);
    Route::post('delete_order_box', [OrderController::class, 'destroy']);

    Route::post('import_order_box', [OrderController::class, 'import']);
    Route::post('empty_order_box', [OrderController::class, 'empty']);

    // status and logs
    Route::post('status_change', [OrderLogController::class, 'status']);
    Route::post('complete_order', [OrderLogController::class, 'complete']);
    Route::get('delete_order/{id}', [OrderLogController::class, 'delete']);
});
