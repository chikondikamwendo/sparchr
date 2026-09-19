<?php

namespace Sparc\Vacancies\Data;

use App\Enums\Gender;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Sparc\Vacancies\Models\Vacancy;

final readonly class CreateApplicationProps
{
    /**
     * @param Collection<int, array> $experiences
     * @param Collection<int, string> $skills
     * @param Collection<int, array> $qualifications
     */
    public function __construct(
        public Vacancy $vacancy,
        public string $name,
        public string $email,
        public Gender $gender,
        public Carbon $dateOfBirth,
        public string $bio,
        public Collection $experiences,
        public Collection $skills,
        public Collection $qualifications,
    ) {
        // ...
    }
}
