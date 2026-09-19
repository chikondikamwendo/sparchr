<?php

namespace Sparc\Vacancies\Enums;

enum VacancyStatus: string
{
    case DRAFT = 'Draft';
    case OPEN = 'Open';
    case IN_REVIEW = 'In Review';
    case CLOSED = 'Closed';
    case CANCELED = 'Canceled';
}
