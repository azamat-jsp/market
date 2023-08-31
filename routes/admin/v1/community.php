<?php

use App\Http\Controllers\V1\Admin\CommunityController;
use App\Tbuy\Community\Enums\Permission as PermissionCommunity;
use Illuminate\Support\Facades\Route;

/** COMMUNITY ROUTES */

Route::middleware(['auth:sanctum'])
    ->name('community.')
    ->prefix('community')
    ->group(function () {
        Route::get('', [CommunityController::class, 'index'])
            ->middleware(PermissionCommunity::VIEW_COMMUNITY_LIST->toString())
            ->name('index');

        Route::post('', [CommunityController::class, 'store'])
            ->middleware(PermissionCommunity::STORE_COMMUNITY->toString())
            ->name('store');

        Route::get('{community}', [CommunityController::class, 'show'])
            ->middleware(PermissionCommunity::SHOW_COMMUNITY->toString())
            ->name('show');

        Route::put('{community}', [CommunityController::class, 'update'])
            ->middleware(PermissionCommunity::UPDATE_COMMUNITY->toString())
            ->name('update');

        Route::delete('{community}', [CommunityController::class, 'destroy'])
            ->middleware(PermissionCommunity::DELETE_COMMUNITY->toString())
            ->name('destroy');
    });
