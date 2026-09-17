<?php

namespace Sparc\Vacancies\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Sparc\Vacancies\Http\Requests\StoreResponsibilityRequest;
use Sparc\Vacancies\Http\Resources\ResponsibilityResource;
use Sparc\Vacancies\Models\Vacancy;

class ResponsibilityController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResponsibilityRequest $request, Vacancy $vacancy): JsonResponse
    {
        $responsibilities = $request->persist($vacancy);

        return Response::json(ResponsibilityResource::collection($responsibilities), 201);
    }
}
