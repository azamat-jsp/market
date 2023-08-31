<?php

use App\Tbuy\Filial\Enums\Permission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Admin\FilialController;

Route::prefix('filial')
    ->name('filial.')
    ->middleware(['auth:sanctum', Permission::VIEW_COMPANY_FILIAL->toString()])
    ->group(function () {
        Route::get('', [FilialController::class, 'index'])
            ->name('index');

        Route::prefix('{company}')->group(function () {
            Route::get('', [FilialController::class, 'byCompany'])
                ->name('byCompany');

            Route::post('', [FilialController::class, 'store'])
                ->middleware(Permission::CREATE_COMPANY_FILIAL->toString())
                ->name('store');

            Route::put('{filial}', [FilialController::class, 'update'])
                ->middleware(Permission::UPDATE_COMPANY_FILIAL->toString())
                ->name('update');

            Route::delete('{filial}', [FilialController::class, 'destroy'])
                ->middleware(Permission::DELETE_COMPANY_FILIAL->toString())
                ->name('destroy');
        });
    });
