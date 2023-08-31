<?php

use App\Http\Controllers\V1\Client\EmployeeController;
use App\Http\Controllers\V1\Client\SearchController;
use App\Http\Controllers\V1\ViewController;
use App\Http\Controllers\V1\ClickController;
use App\Http\Controllers\V1\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('country', CountryController::class)->name('country');

Route::get('/search', [SearchController::class, 'index'])->middleware('locale');

Route::post('vacancies/{vacancy}/views', [ViewController::class, 'vacancies']);
Route::post('vacancies/{vacancy}/clicks', [ClickController::class, 'vacancies']);
