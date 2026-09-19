<?php

namespace Sparc\Vacancies\Data;

use App\Enums\Gender;
use Carbon\Carbon;
use Sparc\Vacancies\Models\Vacancy;

final readonly class CreateApplicationProps
{
    public function __construct(
        public Vacancy $vacancy,
        public string $name,
        public string $email,
        public Gender $gender,
        public Carbon $dateOfBirth,
        public string $bio,
        public array $experiences,
        public array $skills,
        public array $qualifications,
    ) {
        // ...
    }
}
