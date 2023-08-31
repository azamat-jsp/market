<?php

use App\Http\Controllers\V1\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\V1\Client\CompanyController;
use App\Http\Controllers\V1\Client\FilialController;
use App\Http\Controllers\V1\Client\GalleryController;
use App\Http\Controllers\V1\Client\VacancyController;
use App\Tbuy\Banner\Enums\Permission as PermissionBanner;
use App\Tbuy\Filial\Enums\Permission as FilialPermission;
use App\Tbuy\Company\Enums\Permission as CompanyPermission;
use App\Tbuy\Gallery\Enums\Permission as GalleryPermission;
use App\Tbuy\Vacancy\Enums\Permission as PermissionVacancy;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Client\BannerController;

Route::prefix('company')
    ->name('company.')
    ->group(function () {
        Route::post('register', [CompanyController::class, 'store'])
            ->middleware('guest:sanctum')
            ->name('register');

        Route::middleware(['auth:sanctum', CompanyPermission::VIEW_COMPANY->toString()])->group(function () {
            Route::get('{company}/subscribe', [CompanyController::class, 'subscribe'])
                ->middleware(CompanyPermission::SUBSCRIBE_COMPANY->toString())
                ->name('subscribe');

            Route::get('{company}/unsubscribe', [CompanyController::class, 'unsubscribe'])
                ->middleware(CompanyPermission::UNSUBSCRIBE_COMPANY->toString())
                ->name('unsubscribe');

            Route::get('{company}', [AdminCompanyController::class, 'show'])
                ->name('show');

            Route::put('{company}', [CompanyController::class, 'update'])
                ->middleware(CompanyPermission::UPDATE_COMPANY->toString())
                ->name('update');

            Route::post('{company}/logo', [CompanyController::class, 'updateLogo'])
                ->middleware(CompanyPermission::UPDATE_COMPANY_LOGO->toString())
                ->name('logo');

            Route::patch('{company}/score', [CompanyController::class, 'score'])
                ->middleware(CompanyPermission::SCORE_COMPANY->toString())
                ->name('score');

            Route::get('{company}/scores', [CompanyController::class, 'scores'])
                ->name('scores');

            Route::post('{company}/data-confirmation', [CompanyController::class, 'dataConfirmation'])
                ->middleware(CompanyPermission::DATA_CONFIRMATION->toString())
                ->name('data-confirmation');

            Route::post('send-reset-link-email', [CompanyController::class, 'sendResetLinkEmail'])
                ->middleware(CompanyPermission::SEND_RESET_LINK_EMAIL->toString())
                ->name('send-reset-link-email');

            Route::put('set-password', [CompanyController::class, 'setPassword'])
                ->middleware(CompanyPermission::SET_PASSWORD->toString())
                ->name('set-password');

            Route::get('{company}/vacancies', [CompanyController::class, 'vacancies'])
                ->middleware(CompanyPermission::COMPANY_VACANCY_LIST->toString())
                ->name('vacancies');

            Route::prefix('{company}/filial')
                ->name('filial.')
                ->middleware(FilialPermission::VIEW_COMPANY_FILIAL->toString())
                ->group(function () {
                    Route::get('', [FilialController::class, 'index'])->name('index');

                    Route::post('', [FilialController::class, 'store'])
                        ->middleware(FilialPermission::CREATE_COMPANY_FILIAL->toString())
                        ->name('store');

                    Route::put('{filial}', [FilialController::class, 'update'])
                        ->middleware(FilialPermission::UPDATE_COMPANY_FILIAL->toString())
                        ->name('update');

                    Route::delete('{filial}', [FilialController::class, 'destroy'])
                        ->middleware(FilialPermission::DELETE_COMPANY_FILIAL->toString())
                        ->name('destroy');
                });

            Route::prefix('{company}/gallery')
                ->name('gallery.')
                ->middleware(GalleryPermission::VIEW_COMPANY_GALLERIES->toString())
                ->group(function () {
                    Route::get('', [GalleryController::class, 'index'])->name('index');

                    Route::post('', [GalleryController::class, 'store'])
                        ->middleware(GalleryPermission::CREATE_COMPANY_GALLERY->toString())
                        ->name('store');

                    Route::put('{gallery}', [GalleryController::class, 'update'])
                        ->middleware(GalleryPermission::UPDATE_COMPANY_GALLERY->toString())
                        ->name('update');

                    Route::delete('{gallery}', [GalleryController::class, 'destroy'])
                        ->middleware(GalleryPermission::DELETE_COMPANY_GALLERY->toString())
                        ->name('destroy');
                });

            Route::prefix('{company}/banner')
                ->name('banner.')
                ->middleware(PermissionBanner::VIEW_BANNER->toString())
                ->group(function () {
                    Route::get('/', [BannerController::class, 'index']);

                    Route::post('', [BannerController::class, 'store'])
                        ->middleware(PermissionBanner::CREATE_BANNER->toString())
                        ->name('store');

                    Route::get('{banner}', [BannerController::class, 'show'])
                        ->name('show');

                    Route::put('{banner}', [BannerController::class, 'update'])
                        ->middleware(PermissionBanner::UPDATE_BANNER->toString())
                        ->name('update');

                    Route::delete('{banner}', [BannerController::class, 'destroy'])
                        ->middleware(PermissionBanner::DELETE_BANNER->toString())
                        ->name('destroy');
                });

            Route::prefix('{company}/vacancy')
                ->name('vacancy.')
                ->middleware(PermissionVacancy::VIEW_VACANCY_LIST->toString())
                ->group(function () {
                    Route::post('', [VacancyController::class, 'store'])
                        ->middleware(PermissionVacancy::CREATE_VACANCY->toString())
                        ->name('store');
                });

            Route::put('{company}/update-domain', [CompanyController::class, 'updateDomain'])
                ->name('update.domain.')
                ->middleware(CompanyPermission::UPDATE_COMPANY->toString());
        });
    });
