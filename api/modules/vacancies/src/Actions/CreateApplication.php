<?php

namespace Sparc\Vacancies\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Sparc\Vacancies\Data\CreateApplicationProps;
use Sparc\Vacancies\Mail\ApplicationReceived;
use Sparc\Vacancies\Models\Application;

final class CreateApplication
{
    /**
     * Stores a new application and triggers relevant jobs.
     */
    public function handle(CreateApplicationProps $props): Application
    {
        $application = DB::transaction(function () use ($props) {
            $application = $props->vacancy->applications()->create([
                'name' => $props->name,
                'gender' => $props->gender,
                'date_of_birth' => $props->dateOfBirth,
                'bio' => $props->bio,
                'email' => $props->email,
            ]);

            $props->qualifications->each(function (array $qualification) use ($application) {
                $application->qualifications()->create($qualification);
            });

            $props->experiences->each(function (array $experience) use ($application) {
                $responsibilites = collect($experience['responsibilities']);
                $achievements = collect($experience['achievements']);

                $experience = $application->experiences()->create([
                    'institution' => $experience['institution'],
                    'position' => $experience['position'],
                    'started_at' => $experience['started_at'],
                    'ended_at' => $experience['ended_at'],
                ]);

                $responsibilites->each(function (array $responsibility) use ($experience) {
                    $experience->responsibilities()->create($responsibility);
                });

                $achievements->each(function (array $achievement) use ($experience) {
                    $experience->achievements()->create($achievement);
                });
            });

            $props->skills->each(function (array $skill) use ($application) {
                $application->skills()->create($skill);
            });

            $vacancy = $props->vacancy;

            defer(function () use ($vacancy, $application) {
                $applicantName = $application->name;
                $applicantEmail = $application->email;

                Mail::to($applicantEmail, $applicantName)->send(
                    new ApplicationReceived($vacancy, $applicantName)
                );
            });

            return $application;
        });

        return $application;
    }
}
