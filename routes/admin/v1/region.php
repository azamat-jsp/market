<?php

use App\Http\Controllers\V1\Admin\RegionController;
use App\Tbuy\Region\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::name('region.')
    ->prefix('region')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('', [RegionController::class, 'index'])
            ->name('get');

        Route::post('', [RegionController::class, 'store'])
            ->middleware(Permission::STORE_REGION->toString())
            ->name('store');

        Route::put('{region}', [RegionController::class, 'update'])
            ->middleware(Permission::UPDATE_REGION->toString())
            ->name('update');

        Route::delete('{region}', [RegionController::class, 'destroy'])
            ->middleware(Permission::DELETE_REGION->toString())
            ->name('destroy');
    });
