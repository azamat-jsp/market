<?php


use App\Http\Controllers\V1\Admin\BannerController;
use App\Tbuy\Banner\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('banner')
    ->name('banner.')
    ->middleware(['auth:sanctum', Permission::VIEW_BANNER->toString()])
    ->group(function () {
        Route::get('', [BannerController::class, 'index'])->name('index');
        Route::post('', [BannerController::class, 'store'])
            ->name('store')
            ->middleware(Permission::CREATE_BANNER->toString());
        Route::get('{banner}', [BannerController::class, 'show'])
            ->name('show');
        Route::put('{banner}', [BannerController::class, 'update'])
            ->name('update')
            ->middleware(Permission::UPDATE_BANNER->toString());
        Route::delete('{banner}', [BannerController::class, 'destroy'])
            ->name('delete')
            ->middleware(Permission::DELETE_BANNER->toString());
    });
