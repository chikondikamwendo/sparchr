<?php

namespace Sparc\Vacancies\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Sparc\Vacancies\Actions\ResolveVacancy;
use Sparc\Vacancies\Models\Vacancy;

class ResolveVacancyController
{
    public function __construct(private ResolveVacancy $action)
    {
        // ...
    }

    public function __invoke(Vacancy $vacancy): JsonResponse
    {
        $this->action->handle($vacancy);

        return Response::json(null, 204);
    }
}
