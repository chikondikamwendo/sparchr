<?php

use App\Http\Resources\DepartmentResource;
use App\Models\Department;

test('serializes fields', function () {
    $department = Department::factory()->create();

    $serialized = DepartmentResource::make($department)->jsonSerialize();

    expect($serialized)->toEqual([
        'id' => $department->id,
        'slug' => $department->slug,
        'name' => $department->name,
    ]);
});
