<?php

use App\Http\Controllers\V1\Admin\CompanyController;
use App\Tbuy\Company\Enums\Permission;
use Illuminate\Support\Facades\Route;

/** COMPANY ROUTES */

Route::middleware(['auth:sanctum'])
    ->name('company.')
    ->prefix('company')
    ->group(function () {
        Route::get('', [CompanyController::class, 'index'])
            ->middleware(Permission::VIEW_COMPANY->toString())
            ->name('index');

        Route::post('', [CompanyController::class, 'store'])
            ->middleware(Permission::STORE_COMPANY->toString())
            ->name('store');

        Route::get('{company}', [CompanyController::class, 'show'])
            ->middleware(Permission::SHOW_COMPANY->toString())
             ->name('show');

        Route::put('{company}', [CompanyController::class, 'update'])
            ->middleware(Permission::UPDATE_COMPANY->toString())
            ->name('update');

        Route::delete('{company}', [CompanyController::class, 'destroy'])
            ->middleware(Permission::DELETE_COMPANY->toString())
            ->name('destroy');

        Route::patch('{company}/toggle-status', [CompanyController::class,'toggleStatus'])
            ->middleware(Permission::TOGGLE_STATUS_COMPANY->toString())
            ->name('toggle_status');

        Route::get('{company}/employees', [CompanyController::class, 'getEmployees'])
            ->middleware(Permission::VIEW_COMPANY_EMPLOYEES->toString())
            ->name('employees');

        Route::get('{company}/documents', [CompanyController::class, 'getDocuments'])
            ->middleware(Permission::VIEW_COMPANY_DOCUMENTS->toString())
            ->name('get-documents');
    });
