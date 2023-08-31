<?php

use App\Http\Controllers\V1\Client\CategoryController;
use App\Tbuy\Category\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('category')
    ->name('category.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('{category}/attributes', [CategoryController::class, 'attributes'])
            ->middleware(Permission::VIEW_CATEGORY->toString())
            ->name('attributes');
    });
