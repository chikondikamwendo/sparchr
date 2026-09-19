<?php

namespace Sparc\Vacancies\Models;

use App\Enums\Gender;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Sparc\Vacancies\Database\Factories\ApplicationFactory;

/**
 * @property int $id
 * @property int $vacancy_id
 * @property string $name
 * @property Gender $gender
 * @property string $email
 * @property string $bio
 * @property Carbon $date_of_birth
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method BelongsTo<Vacancy> vacancy()
 * @method HasMany<Experience> experiences()
 * @method HasMany<Skill> skills()
 * @method MorphMany<Qualification> qualifications()
 */
class Application extends Model
{
    /** @use HasFactory<ApplicationFactory> */
    use HasFactory;

    /** Attributes that are guarded. */
    protected $guarded = [];

    /** Get casted attributes. */
    public function casts(): array
    {
        return [
            'gender' => Gender::class,
        ];
    }

    /**
     * Vacancy application belongs to.
     *
     * @return BelongsTo<Vacancy, $this>
     */
    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }

    /**
     * Applicants qualifications.
     * 
     * @return MorphMany<Qualification, $this>
     */
    public function qualifications(): MorphMany
    {
        return $this->morphMany(Qualification::class, 'qualificationable');
    }
}
