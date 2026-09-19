<?php

namespace Sparc\Vacancies\Enums;

enum VacancyStatus: string
{
    case DRAFT = 'Draft';
    case OPEN = 'Open';
    case CLOSED = 'Closed';
}
