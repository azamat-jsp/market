<?php

use App\Http\Controllers\V1\Admin\VacancyCategoryController;
use App\Http\Controllers\V1\Admin\VacancyController;
use App\Tbuy\Vacancy\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('vacancies')
    ->name('vacancies.')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::middleware([Permission::VIEW_VACANCY_LIST->toString()])
            ->group(function () {
                Route::get('', [VacancyController::class, 'index'])
                    ->name('index');

                Route::post('', [VacancyController::class, 'store'])
                    ->middleware(Permission::CREATE_VACANCY->toString())
                    ->name('store');

                Route::get('{vacancy}', [VacancyController::class, 'show'])
                    ->name('show');

                Route::put('{vacancy}', [VacancyController::class, 'update'])
                    ->middleware(Permission::UPDATE_VACANCY->toString())
                    ->name('update');

                Route::delete('{vacancy}', [VacancyController::class, 'destroy'])
                    ->middleware(Permission::DELETE_VACANCY->toString())
                    ->name('destroy');

                Route::patch('{vacancy}/toggle-status', [VacancyController::class, 'toggleStatus'])
                    ->middleware(Permission::TOGGLE_STATUS_VACANCY->toString())
                    ->name('toggle_status');

                Route::get('favorite-vacancies', [VacancyController::class, 'favoriteVacancies'])
                    ->name('favorite_vacancies');
            });

        Route::prefix('categories')
            ->name('categories.')
            ->middleware([Permission::VIEW_VACANCY_CATEGORY_LIST->toString()])
            ->group(function () {
                Route::get('', [VacancyCategoryController::class, 'index'])
                    ->name('index');

                Route::post('', [VacancyCategoryController::class, 'store'])
                    ->middleware(Permission::CREATE_VACANCY_CATEGORY->toString())
                    ->name('store');

                Route::get('{category}', [VacancyCategoryController::class, 'show'])
                    ->name('show');

                Route::put('{category}', [VacancyCategoryController::class, 'update'])
                    ->middleware(Permission::UPDATE_VACANCY_CATEGORY->toString())
                    ->name('update');

                Route::delete('{category}', [VacancyCategoryController::class, 'destroy'])
                    ->middleware(Permission::DELETE_VACANCY_CATEGORY->toString())
                    ->name('destroy');
            });
    });
