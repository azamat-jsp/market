<?php

use App\Http\Controllers\V1\Admin\AttributeCategoryController;
use App\Tbuy\AttributeCategory\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('attribute-category')
    ->name('attributeCategory.')
    ->middleware(['auth:sanctum', Permission::VIEW_ATTRIBUTE_CATEGORY->toString()])
    ->group(function () {
        Route::get('', [AttributeCategoryController::class, 'index'])
            ->name('index');

        Route::post('', [AttributeCategoryController::class, 'store'])
            ->middleware(Permission::CREATE_ATTRIBUTE_CATEGORY->toString())
            ->name('store');

        Route::put('{attributeCategory}', [AttributeCategoryController::class, 'update'])
            ->middleware(Permission::UPDATE_ATTRIBUTE_CATEGORY->toString())
            ->name('update');

        Route::delete('{attributeCategory}', [AttributeCategoryController::class, 'destroy'])
            ->middleware(Permission::DELETE_ATTRIBUTE_CATEGORY->toString())
            ->name('destroy');
    });
