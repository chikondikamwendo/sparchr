<?php

namespace Sparc\Vacancies\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Sparc\Vacancies\Http\Requests\StoreQualificationRequest;
use Sparc\Vacancies\Http\Resources\QualificationResource;
use Sparc\Vacancies\Models\Vacancy;

class QualificationController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQualificationRequest $request, Vacancy $vacancy): JsonResponse
    {
        $qualifications = $request->persist($vacancy);

        return Response::json(QualificationResource::collection($qualifications), 201);
    }
}
