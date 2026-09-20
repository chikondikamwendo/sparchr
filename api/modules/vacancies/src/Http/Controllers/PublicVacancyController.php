<?php

namespace Sparc\Vacancies\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Http\Resources\VacancyResource;
use Sparc\Vacancies\Models\Vacancy;

class PublicVacancyController
{
    const int DEFAULT_PAGE_ITEMS = 15;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $per_page = $request->per_page ?? static::DEFAULT_PAGE_ITEMS;

        $vacancies = Vacancy::query()
            ->where('status', VacancyStatus::OPEN)
            ->cursorPaginate($per_page)
            ->withQueryString()
            ->through(function (Vacancy $vacancy) {
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
}
