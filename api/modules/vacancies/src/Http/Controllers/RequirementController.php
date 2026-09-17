<?php

namespace Sparc\Vacancies\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Sparc\Vacancies\Http\Requests\StoreRequirementRequest;
use Sparc\Vacancies\Http\Resources\RequirementResource;
use Sparc\Vacancies\Models\Vacancy;

class RequirementController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequirementRequest $request, Vacancy $vacancy): JsonResponse
    {
        $requirements = $request->persist($vacancy);

        return Response::json(RequirementResource::collection($requirements), 201);
    }
}
