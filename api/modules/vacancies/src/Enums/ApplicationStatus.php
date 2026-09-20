<?php

namespace Sparc\Vacancies\Enums;

enum ApplicationStatus: string
{
    case PENDING_SCORE = 'Pending Score';
    case IN_REVIEW = 'In Review';
    case SHORTLISTED = 'Shortlisted';
    case WAITLISTED = 'Waitlisted';
    case ACCEPTED = 'Accepted';
    case REJECTED = 'Rejected';

    public static function pending(): array
    {
        return [
            self::IN_REVIEW,
            self::PENDING_SCORE,
            self::SHORTLISTED,
        ];
    }
}
