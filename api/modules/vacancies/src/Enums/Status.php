<?php

namespace Sparc\Vacancies\Enums;

enum Status: string
{
    case DRAFT = 'Draft';
    case OPEN = 'Open';
    case CLOSED = 'Closed';
}
