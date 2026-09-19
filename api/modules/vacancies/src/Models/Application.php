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
use Sparc\Vacancies\Enums\ApplicationStatus as Status;

/**
 * @property int $id
 * @property int $vacancy_id
 * @property string $name
 * @property Gender $gender
 * @property string $email
 * @property string $bio
 * @property Status $status
 * @property int|null $score
 * @property string|null $remarks
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
            'status' => Status::class,
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

    /**
     * Applicants experiences.
     *
     * @return HasMany<Experience, $this>
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Applicants skills.
     *
     * @return HasMany<Skill, $this>
     */
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
