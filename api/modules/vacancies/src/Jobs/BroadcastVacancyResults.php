<?php

namespace Sparc\Vacancies\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Sparc\Vacancies\Mail\ApplicationResult;
use Sparc\Vacancies\Models\Application;
use Sparc\Vacancies\Models\Vacancy;

class BroadcastVacancyResults implements ShouldBeUnique, ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Vacancy $vacancy)
    {
        //
    }

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        return $this->vacancy->slug;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->vacancy->applications()->each(function (Application $application) {
            $applicantName = $application->name;
            $applicantEmail = $application->email;

            Mail::to($applicantEmail, $applicantName)->send(
                new ApplicationResult(
                    $applicantName,
                    $this->vacancy->title,
                    $application->status,
                ),
            );
        });
    }
}
