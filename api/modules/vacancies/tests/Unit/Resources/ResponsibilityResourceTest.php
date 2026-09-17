<?php

use Sparc\Vacancies\Http\Resources\ResponsibilityResource;
use Sparc\Vacancies\Models\Responsibility;

test('serializes fields', function () {
    $responsibility = Responsibility::factory()->create();

    $serialized = ResponsibilityResource::make($responsibility)->jsonSerialize();

    expect($serialized)->toEqual([
        'id' => $responsibility->id,
        'title' => $responsibility->title,
        'description' => $responsibility->description,
    ]);
});
