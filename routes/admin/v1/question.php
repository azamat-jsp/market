<?php

use Illuminate\Support\Facades\Route;
use App\Tbuy\Question\Enums\Permission;
use App\Http\Controllers\V1\Admin\QuestionController;

Route::prefix('question')
    ->name('question.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [QuestionController::class, 'index'])
            ->name('index');

        Route::post('/', [QuestionController::class, 'store'])
            ->middleware(Permission::STORE_QUESTION->toString())
            ->name('store');

        Route::get('/{question}', [QuestionController::class, 'show'])
            ->name('show');

        Route::put('/{question}', [QuestionController::class, 'update'])
            ->middleware(Permission::UPDATE_QUESTION->toString())
            ->name('update');

        Route::delete('/{question}', [QuestionController::class, 'destroy'])
            ->middleware(Permission::DELETE_QUESTION->toString())
            ->name('destroy');
    });
