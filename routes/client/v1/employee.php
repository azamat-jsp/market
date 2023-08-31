<?php

use App\Http\Controllers\V1\Client\EmployeeController;
use App\Tbuy\Employee\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('employee')
    ->name('employee.')
    ->group(function () {
        Route::middleware(['auth:sanctum', Permission::ViEW_COMPANY_EMPLOYEE->toString()])
            ->group(function () {
                Route::get('', [EmployeeController::class, 'index'])
                    ->name('index');

                Route::post('', [EmployeeController::class, 'store'])
                    ->middleware(Permission::STORE_COMPANY_EMPLOYEE->toString())
                    ->name('store');

                Route::get('{employee}', [EmployeeController::class, 'show'])
                    ->middleware(Permission::SHOW_COMPANY_EMPLOYEE->toString())
                    ->name('show');

                Route::put('{employee}', [EmployeeController::class, 'update'])
                    ->middleware(Permission::UPDATE_COMPANY_EMPLOYEE->toString())
                    ->name('update');

                Route::delete('{employee}', [EmployeeController::class, 'destroy'])
                    ->middleware(Permission::DELETE_COMPANY_EMPLOYEE->toString())
                    ->name('delete');

                Route::post('reset-password', [EmployeeController::class, 'resetPassword'])
                    ->name('reset-password');

                Route::get('permissions-structure', [EmployeeController::class, 'getPermissionsStructure'])
                    ->middleware(Permission::VIEW_PERMISSIONS_EMPLOYEE->toString())
                    ->name('permissions');
            });

        Route::middleware(['guest:sanctum'])
            ->group(function () {

                Route::post('login', [EmployeeController::class, 'login'])
                    ->name('login');
            });
    });
