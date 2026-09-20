<?php

namespace Sparc\Vacancies\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Sparc\Vacancies\Http\Requests\UpdateApplicationRequest;
use Sparc\Vacancies\Http\Resources\ApplicationResource;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Vacancy;

class ApplicationController
{
    public function __invoke(UpdateApplicationRequest $request, Vacancy $vacancy, Application $application): JsonResponse
    {
        $request->persist($application);

        $application->refresh();

        return Response::json(ApplicationResource::make($application));
    }
}
