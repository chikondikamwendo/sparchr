<?php

use Illuminate\Support\Facades\Route;
use Sparc\Vacancies\Http\Controllers\QualificationController;
use Sparc\Vacancies\Http\Controllers\RequirementController;
use Sparc\Vacancies\Http\Controllers\ResponsibilityController;
use Sparc\Vacancies\Http\Controllers\VacancyController;

Route::middleware(['api', 'auth:sanctum'])->prefix('v1/vacancies')->group(function () {
    Route::resource('/', VacancyController::class)->only(['store', 'index']);

    Route::prefix('/{vacancy}')->group(function () {
        Route::resource('/responsibilities', ResponsibilityController::class)->only(['store']);
        Route::resource('/requirements', RequirementController::class)->only(['store']);
        Route::resource('/qualifications', QualificationController::class)->only(['store']);
    });
});
