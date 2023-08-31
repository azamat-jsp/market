<?php

use App\Http\Controllers\V1\Client\CommunityController;
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

        Route::get('{community}', [CommunityController::class, 'show'])
            ->middleware(PermissionCommunity::SHOW_COMMUNITY->toString())
            ->name('show');
    });
