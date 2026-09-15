<?php

namespace Sparc\Vacancies\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $slug
 * @property string $title
 * @property string $brief
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @method BelongsTo<User> user()
 * @method HasMany<Category> categories()
 * @method HasMany<Responsibility> responsibilities()
 * @method HasMany<Requirement> requirements()
 * @method HasMany<Qualification> qualifications()
 */
class Vacancy extends Model
{
    /** @use HasFactory<\Sparc\Vacancies\Database\Factories\VacancyFactory> */
    use HasFactory;

    /** Attributes that are guarded */
    protected $guarded = [];
}
