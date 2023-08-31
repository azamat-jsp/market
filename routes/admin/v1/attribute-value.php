<?php

use App\Http\Controllers\V1\Admin\AttributeValueController;
use App\Tbuy\AttributeValue\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', Permission::VIEW_ATTRIBUTE_VALUE->toString()])
    ->prefix('attribute-value')
    ->name('attribute_value.')->group(function () {

        Route::post('', [AttributeValueController::class, 'store'])
            ->middleware(Permission::CREATE_ATTRIBUTE_VALUE->toString())
            ->name('store');

        Route::put('{value}', [AttributeValueController::class, 'update'])
            ->middleware(Permission::UPDATE_ATTRIBUTE_VALUE->toString())
            ->name('update');

        Route::delete('{value}', [AttributeValueController::class, 'destroy'])
            ->middleware(Permission::DELETE_ATTRIBUTE_VALUE->toString())
            ->name('destroy');
    });
