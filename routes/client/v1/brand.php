<?php

use App\Http\Controllers\V1\Client\BrandController;
use App\Tbuy\Brand\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('brand')
    ->name('brand.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('{brand}/subscribe', [BrandController::class, 'subscribe'])
            ->middleware(Permission::SUBSCRIBE_BRAND->toString())
            ->name('subscribe');

        Route::get('{brand}/unsubscribe', [BrandController::class, 'unsubscribe'])
            ->middleware(Permission::UNSUBSCRIBE_BRAND->toString())
            ->name('unsubscribe');
    });
