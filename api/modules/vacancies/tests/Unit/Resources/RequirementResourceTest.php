<?php

use Sparc\Vacancies\Http\Resources\RequirementResource;
use Sparc\Vacancies\Models\Requirement;

test('serializes fields', function () {
    $requirement = Requirement::factory()->create();

    $serialized = RequirementResource::make($requirement)->jsonSerialize();

    expect($serialized)->toEqual([
        'id' => $requirement->id,
        'title' => $requirement->title,
        'description' => $requirement->description,
    ]);
});
