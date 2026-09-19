<?php

namespace Sparc\Vacancies\Actions;

use Sparc\Vacancies\Ai\Agents\Recruiter;
use Sparc\Vacancies\Enums\ApplicationStatus;
use Sparc\Vacancies\Enums\VacancyStatus;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Vacancy;

final class ScoreApplications
{
    public function __invoke(Recruiter $recruiter)
    {
        $vacancies = collect([]);

        $applications = Application::query()
            ->whereRelation('vacancy', 'status', '!=', VacancyStatus::CLOSED)
            ->orWhereRelation('vacancy', 'staus', '!=', VacancyStatus::DRAFT)
            ->where('status', ApplicationStatus::PENDING_SCORE)
            ->with(['experiences', 'skills', 'qualifications'])
            ->limit(10)
            ->get();

        $applications->each(function (Application $application) use ($vacancies) {
            if ($vacancies->contains(fn (Vacancy $vacancy) => $vacancy->id === $application->vacancy_id)) {
                return;
            }

            $vacancy = Vacancy::where('id', $application->vacancy_id)
                ->with(['requirements', 'responsibilities', 'qualifications'])
                ->first();

            $vacancies->push($vacancy);
        });

        if ($vacancies->isEmpty() || $applications->isEmpty()) {
            return;
        }

        $json = $vacancies->map(fn (Vacancy $vacancy) => [
            'vacancy' => $vacancy,
            'applications' => $applications->filter(
                fn (Application $application) => $application->vacancy_id === $vacancy->id
            ),
        ])->toJson();

        $response = $recruiter->prompt('Examine and score the following applications: '.$json);
        $results = collect($response['results'] ?? []);

        $results->each(function (array $result) use ($applications) {
            $application = $applications->firstWhere(fn (Application $application) => $application->id === $result['application_id']);

            if (! $application) {
                return;
            }

            $application->update([
                'score' => $result['score'],
                'remarks' => $result['remarks'],
                'status' => ApplicationStatus::IN_REVIEW,
            ]);
        });
    }
}
