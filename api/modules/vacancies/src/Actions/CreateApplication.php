<?php

namespace Sparc\Vacancies\Actions;

use Illuminate\Support\Facades\DB;
use Sparc\Vacancies\Data\CreateApplicationProps;
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

            return $application;
        });

        return $application;
    }
}
