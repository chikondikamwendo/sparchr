<?php

use Illuminate\Support\Facades\Route;
use Sparc\Vacancies\Http\Controllers\ResponsibilityController;
use Sparc\Vacancies\Http\Controllers\VacancyController;

Route::middleware(['api', 'auth:sanctum'])->prefix('v1/vacancies')->group(function () {
    Route::resource('/', VacancyController::class)->only(['store']);
    Route::resource('/{vacancy}/responsibilities', ResponsibilityController::class)->only(['store']);
});
