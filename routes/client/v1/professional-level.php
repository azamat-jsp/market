<?php

use App\Http\Controllers\V1\Client\ProfessionalLevelController;
use App\Tbuy\ProfessionalLevel\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('professional-levels')
    ->name('professional-levels.')
    ->middleware(['auth:sanctum', Permission::VIEW_LEVEL_LIST->toString()])
    ->group(function () {
        Route::get('', [ProfessionalLevelController::class, 'index'])
            ->name('index');
    });
