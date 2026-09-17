<?php

namespace Sparc\Vacancies\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Sparc\Vacancies\Http\Requests\StoreVacancyRequest;
use Sparc\Vacancies\Http\Resources\VacancyResource;
use Sparc\Vacancies\Models\Vacancy;

class VacancyController
{
    const int DEFAULT_PAGE_ITEMS = 15;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $per_page = $request->per_page ?? static::DEFAULT_PAGE_ITEMS;

        $vacancies = Vacancy::cursorPaginate($per_page)->withQueryString()->through(function (Vacancy $vacancy) {
            return VacancyResource::make($vacancy);
        });

        return Response::json([
            'total' => Vacancy::count(),
            'path' => $vacancies->path(),
            'per_page' => $vacancies->perPage(),
            'next' => $vacancies->nextPageUrl(),
            'prev' => $vacancies->previousPageUrl(),
            'items' => $vacancies->items(),
        ]);
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
