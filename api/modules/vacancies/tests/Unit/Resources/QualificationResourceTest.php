<?php

use Sparc\Vacancies\Http\Resources\QualificationResource;
use Sparc\Vacancies\Models\Qualification;

test('serializes fields', function () {
    $qualification = Qualification::factory()->create();

    $serialized = QualificationResource::make($qualification)->jsonSerialize();

    expect($serialized)->toEqual([
        'id' => $qualification->id,
        'field' => $qualification->field,
        'description' => $qualification->description,
        'level' => $qualification->level,
        'required' => $qualification->required,
    ]);
});
