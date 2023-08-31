<?php

use App\Http\Controllers\V1\Client\GuestResumeController;
use App\Http\Controllers\V1\Client\ResumeController;
use App\Tbuy\Resume\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix('resume')
    ->name('resume.')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::post('', [ResumeController::class, 'store'])
            ->middleware(Permission::RESUME_STORE->toString())
            ->name('store');

        Route::get('{company}', [ResumeController::class, 'index'])
            ->middleware(Permission::RESUME_LIST->toString())
            ->name('index');

        Route::get('{vacancy}/feedbackOnThisVacancy', [ResumeController::class, 'feedbackOnThisVacancy'])
            ->middleware(Permission::FEEDBACK_ON_VACANCY->toString())
            ->name('feedbackOnThisVacancy');

        Route::post('{resume}/favorite', [ResumeController::class, 'favorite'])
            ->middleware(Permission::RESUME_FAVORITE_STORE->toString())
            ->name('favorite');

        Route::get('favorite', [ResumeController::class, 'getFavoriteResumes'])
            ->middleware(Permission::RESUME_FAVORITE_GET->toString())
            ->name('getFavorite');
    });

Route::prefix('guest/resume')
    ->name('resume.')
    ->middleware(['guest:sanctum'])
    ->group(function () {
        Route::post('', [GuestResumeController::class, 'store'])
            ->name('guest_store');
    });
