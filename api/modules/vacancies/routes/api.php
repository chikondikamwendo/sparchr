<?php

use Illuminate\Support\Facades\Route;
use Sparc\Vacancies\Http\Controllers\ApplicationController;
use Sparc\Vacancies\Http\Controllers\PublicApplicationController;
use Sparc\Vacancies\Http\Controllers\PublicVacancyController;
use Sparc\Vacancies\Http\Controllers\QualificationController;
use Sparc\Vacancies\Http\Controllers\RequirementController;
use Sparc\Vacancies\Http\Controllers\ResolveVacancyController;
use Sparc\Vacancies\Http\Controllers\ResponsibilityController;
use Sparc\Vacancies\Http\Controllers\VacancyController;

Route::middleware(['api', 'auth:sanctum'])->prefix('v1/vacancies')->group(function () {
    Route::resource('', VacancyController::class)
        ->parameter('', 'vacancy')
        ->only(['store', 'index', 'show', 'update']);

    Route::prefix('/{vacancy}')->group(function () {
        Route::resource('/responsibilities', ResponsibilityController::class)->only(['store']);
        Route::resource('/requirements', RequirementController::class)->only(['store']);
        Route::resource('/qualifications', QualificationController::class)->only(['store']);
        Route::patch('/applications/{application}', ApplicationController::class);
        Route::put('/applications/{application}', ApplicationController::class);
        Route::get('/resolve', ResolveVacancyController::class);
    });
});

Route::middleware(['api'])->prefix('v1/public')->group(function () {
    Route::resource('/vacancies', PublicVacancyController::class)->only(['index']);
    Route::post('/vacancies/{vacancy}/applications', PublicApplicationController::class);
});
