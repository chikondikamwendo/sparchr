<?php

namespace Sparc\Vacancies\Actions;

use Illuminate\Support\Facades\DB;
use Sparc\Vacancies\Enums\ApplicationStatus;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Jobs\BroadcastVacancyResults;
use Sparc\Vacancies\Models\Vacancy;

final class ResolveVacancy
{
    public function handle(Vacancy $vacancy)
    {
        if ($vacancy->status === VacancyStatus::CLOSED || $vacancy->status === VacancyStatus::CANCELED) {
            return;
        }

        DB::transaction(function () use ($vacancy) {
            $vacancy->update(['status' => VacancyStatus::CLOSED]);

            $vacancy->applications()
                ->whereIn('status', ApplicationStatus::pending())
                ->update(['status' => ApplicationStatus::REJECTED]);
        });

        BroadcastVacancyResults::dispatch($vacancy);
    }
}
