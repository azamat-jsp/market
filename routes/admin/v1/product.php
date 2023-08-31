<?php


use App\Http\Controllers\V1\Admin\ProductController;
use App\Tbuy\Product\Enums\Permission;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('product')
    ->name('product.')
    ->middleware(['auth:sanctum', Permission::VIEW_PRODUCT_LIST->toString()])
    ->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('list');
        Route::get('{product}', [ProductController::class, 'show'])
            ->name('show');
        Route::post('', [ProductController::class, 'store'])
            ->middleware(Permission::STORE_PRODUCT->toString())
            ->name('store');
        Route::put('{product}', [ProductController::class, 'update'])
            ->middleware(Permission::UPDATE_PRODUCT->toString())
            ->name('update');
        Route::patch('{product}/toggle-status', [ProductController::class, 'toggleStatus'])
            ->middleware(Permission::TOGGLE_PRODUCT_STATUS->toString())
            ->name('toggle-status');
        Route::get('zero-amount', [ProductController::class, 'indexZeroAmount'])
            ->middleware(Permission::VIEW_ZERO_AMOUNT_PRODUCT_LIST->toString())
            ->name('list.zero-amount');
        Route::patch('{product}', [ProductController::class, 'setAttribute'])
            ->middleware(Permission::SET_PRODUCT_ATTRIBUTE->toString())
            ->name('set_attribute');
        Route::patch('{product}/extend-name', [ProductController::class, 'extendName'])
            ->middleware(Permission::EXTEND_PRODUCT_NAME->toString())
            ->name('extend_name');

    });
