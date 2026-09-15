<?php

namespace Sparc\Vacancies\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Sparc\Vacancies\Models\Vacancy;
use Sparc\Vacancies\Http\Requests\StoreVacancyRequest;
use Sparc\Vacancies\Http\Resources\VacancyResource;

class VacancyController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVacancyRequest $request): JsonResponse
    {
        $vacancy = $request->persist();

        return Response::json(VacancyResource::make($vacancy), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        //
    }
}
