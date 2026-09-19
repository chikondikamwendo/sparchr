<?php

namespace Sparc\Vacancies\Models;

use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Sparc\Vacancies\Database\Factories\VacancyFactory;
use Sparc\Vacancies\Enums\VacancyStatus;

/**
 * @property int $id
 * @property int $user_id
 * @property int $department_id
 * @property string $slug
 * @property string $title
 * @property string $brief
 * @property VacancyStatus $status
 * @property Carbon|null $expires_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method BelongsTo<User> user()
 * @method BelongsTo<Department> department()
 * @method HasMany<Requirement> requirements()
 * @method HasMany<Application> applications()
 * @method MorphMany<Responsibility> responsibilities()
 * @method MorphMany<Qualification> qualifications()
 */
class Vacancy extends Model
{
    /** @use HasFactory<VacancyFactory> */
    use HasFactory;

    /** Attributes that are guarded */
    protected $guarded = [];

    /**
     * Get attributes that are casted.
     *
     * @return list<string>
     */
    protected function casts(): array
    {
        return [
            'status' => VacancyStatus::class,
        ];
    }

    /**
     * Get the route binding key.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The user that created the vacancy.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Department vacancy is under.
     *
     * @return BelongsTo<Department, $this>
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Responsibilities for this vacancy.
     *
     * @return MorphMany<Responsibility, $this>
     */
    public function responsibilities(): MorphMany
    {
        return $this->morphMany(Responsibility::class, 'responsibilitable');
    }

    /**
     * Vacancy requirements.
     *
     * @return HasMany<Requirement, $this>
     */
    public function requirements(): HasMany
    {
        return $this->hasMany(Requirement::class);
    }

    /**
     * Vacancy qualifications.
     *
     * @return MorphMany<Qualification, $this>
     */
    public function qualifications(): MorphMany
    {
        return $this->morphMany(Qualification::class, 'qualificationable');
    }

    /**
     * Vacancy applications.
     *
     * @return HasMany<Application, $this>
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
