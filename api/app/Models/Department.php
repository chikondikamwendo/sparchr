<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\DepartmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Department extends Model
{
    /** @use HasFactory<DepartmentFactory> */
    use HasFactory;
}
