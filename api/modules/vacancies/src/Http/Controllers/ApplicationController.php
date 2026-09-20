<?php

namespace Sparc\Vacancies\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Sparc\Vacancies\Actions\CreateApplication;
use Sparc\Vacancies\Http\Requests\StoreApplicationRequest;
use Sparc\Vacancies\Http\Resources\ApplicationResource;
use Sparc\Vacancies\Models\Vacancy;

class ApplicationController
{
    public function __construct(private CreateApplication $createApplicationAction)
    {
        // ...
    }

    /** Store a newly created resource in storage. */
    public function __invoke(StoreApplicationRequest $request, Vacancy $vacancy): JsonResponse
    {
        $application = $request->persist($this->createApplicationAction, $vacancy);

        return Response::json(ApplicationResource::make($application), 201);
    }
}
