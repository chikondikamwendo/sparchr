<?php

use Illuminate\Support\Facades\Route;
use Sparc\Vacancies\Http\Controllers\ApplicationController;
use Sparc\Vacancies\Http\Controllers\PublicVacancyController;
use Sparc\Vacancies\Http\Controllers\QualificationController;
use Sparc\Vacancies\Http\Controllers\RequirementController;
use Sparc\Vacancies\Http\Controllers\ResponsibilityController;
use Sparc\Vacancies\Http\Controllers\VacancyController;

Route::middleware(['api', 'auth:sanctum'])->prefix('v1/vacancies')->group(function () {
    Route::resource('', VacancyController::class)
        ->parameter('', 'vacancy')
        ->only(['store', 'index', 'show']);

    Route::prefix('/{vacancy}')->group(function () {
        Route::resource('/responsibilities', ResponsibilityController::class)->only(['store']);
        Route::resource('/requirements', RequirementController::class)->only(['store']);
        Route::resource('/qualifications', QualificationController::class)->only(['store']);
    });
});

Route::middleware(['api'])->prefix('v1/public')->group(function () {
    Route::resource('/vacancies', PublicVacancyController::class)->only(['index']);
    Route::post('/vacancies/{vacancy}/applications', ApplicationController::class);
});
