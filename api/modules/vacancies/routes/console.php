<?php

use Illuminate\Support\Facades\Schedule;
use Sparc\Vacancies\Actions\ScoreApplications;

Schedule::call(new ScoreApplications)->everyFiveMinutes();
