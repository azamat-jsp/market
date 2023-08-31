<?php

use App\Http\Controllers\V1\Admin\CategoryAttributeController;
use App\Http\Controllers\V1\Admin\CategoryController;
use App\Tbuy\Category\Enums\Permission;
use App\Tbuy\Attribute\Enums\Permission as AttributePermission;
use Illuminate\Support\Facades\Route;

/** CATEGORY ROUTES */

Route::middleware(['auth:sanctum'])
    ->name('category.')
    ->prefix('category')
    ->group(function () {
        Route::get('', [CategoryController::class, 'index'])
            ->middleware(Permission::VIEW_CATEGORY->toString())
            ->name('index');
        Route::get('{category}/level', [CategoryController::class, 'getChildLevel'])
            ->middleware(Permission::RATIO_CATEGORY->toString())
            ->name('ratio');
        Route::put('{category}/{CategoryStatus}', [CategoryController::class, 'switchStatus'])
            ->middleware(Permission::SWITCH_STATUS_CATEGORY->toString())
            ->name('status');
        Route::post('', [CategoryController::class, 'store'])
            ->middleware(Permission::STORE_CATEGORY->toString())
            ->name('store');
        Route::get('{category}', [CategoryController::class, 'show'])
            ->middleware(Permission::SHOW_CATEGORY->toString())
            ->name('show');
        Route::put('{category}', [CategoryController::class, 'update'])
            ->middleware(Permission::UPDATE_CATEGORY->toString())
            ->name('update');
        Route::delete('{category}', [CategoryController::class, 'destroy'])
            ->middleware(Permission::DELETE_CATEGORY->toString())
            ->name('destroy');
        Route::get('{category}/products', [CategoryController::class, 'lastProducts'])
            ->middleware(Permission::SHOW_CATEGORY_PRODUCTS->toString())
            ->name('show.products');


        Route::prefix('{category}/attributes')
            ->name('attributes.')
            ->middleware([AttributePermission::VIEW_ATTRIBUTE->toString()])
            ->group(function () {

                Route::post('store', [CategoryAttributeController::class, 'store'])
                    ->middleware(AttributePermission::CREATE_ATTRIBUTE->toString())
                    ->name('store');

                Route::put('update', [CategoryAttributeController::class, 'update'])
                    ->middleware(AttributePermission::UPDATE_ATTRIBUTE->toString())
                    ->name('update');

                Route::delete('delete', [CategoryAttributeController::class, 'destroy'])
                    ->middleware(AttributePermission::DELETE_ATTRIBUTE->toString())
                    ->name('destroy');
            });
    });
