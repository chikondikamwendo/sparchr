<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth:sanctum'])->prefix('v1/vacancies')->group(function () {
    // ...
});