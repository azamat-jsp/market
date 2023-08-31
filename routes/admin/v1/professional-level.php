<?php

use App\Http\Controllers\V1\Admin\ProfessionalLevelController;
use App\Tbuy\ProfessionalLevel\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('professional-levels')
    ->name('professional-levels.')
    ->middleware(['auth:sanctum', Permission::VIEW_LEVEL_LIST->toString()])
    ->group(function () {
        Route::get('', [ProfessionalLevelController::class, 'index'])
            ->name('index');

        Route::post('', [ProfessionalLevelController::class, 'store'])
            ->middleware(Permission::CREATE_LEVEL->toString())
            ->name('store');

        Route::get('{level}', [ProfessionalLevelController::class, 'show'])
            ->name('show');

        Route::put('{level}', [ProfessionalLevelController::class, 'update'])
            ->middleware(Permission::UPDATE_LEVEL->toString())
            ->name('update');

        Route::delete('{level}', [ProfessionalLevelController::class, 'destroy'])
            ->middleware(Permission::DELETE_LEVEL->toString())
            ->name('destroy');
});
