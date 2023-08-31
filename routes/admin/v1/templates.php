<?php


use App\Http\Controllers\V1\Admin\TemplatesController;
use App\Tbuy\Banner\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('templates')
    ->name('templates.')
    ->middleware(['auth:sanctum', Permission::VIEW_BANNER->toString()])
    ->group(function () {
        Route::get('', [TemplatesController::class, 'index'])->name('index');
        Route::get('{templates}', [TemplatesController::class, 'show'])
            ->name('show');
        Route::post('', [TemplatesController::class, 'store'])
            ->name('store')
            ->middleware(Permission::CREATE_BANNER->toString());
        Route::put('{templates}', [TemplatesController::class, 'update'])
            ->name('update')
            ->middleware(Permission::UPDATE_BANNER->toString());
        Route::delete('{templates}', [TemplatesController::class, 'destroy'])
            ->name('delete')
            ->middleware(Permission::DELETE_BANNER->toString());
    });
