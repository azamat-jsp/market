<?php

use App\Http\Controllers\V1\Admin\FilialController;
use App\Tbuy\Filial\Enums\Permission;
use Illuminate\Support\Facades\Route;

/** FILIAL ROUTES */

Route::middleware(['auth:sanctum'])
    ->name('filial.')
    ->prefix('filial')
    ->group(function () {
        Route::get('', [FilialController::class, 'index'])
            ->middleware(Permission::VIEW_ALL_FILIAL->toString())
            ->name('index');
    });
