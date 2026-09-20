<?php

namespace Sparc\Vacancies\Actions;

use Sparc\Vacancies\Enums\ApplicationStatus;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Models\Vacancy;

final class ResolveVacancy
{
    public function handle(Vacancy $vacancy)
    {
        if ($vacancy->status === VacancyStatus::CLOSED) {
            return;
        }

        $vacancy->update(['status' => VacancyStatus::CLOSED]);

        $vacancy->applications()
            ->whereIn('status', ApplicationStatus::pending())
            ->update(['status' => ApplicationStatus::REJECTED]);
    }
}
