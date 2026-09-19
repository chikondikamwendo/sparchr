<?php

namespace Sparc\Vacancies\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int $id
 * @property int $application_id
 * @property string $institution
 * @property string $position
 * @property Carbon $started_at
 * @property Carbon|null $ended_at
 * 
 * @method BelongsTo<Application> application()
 * @method MorphMany<Responsibility> responsibilities()
 * @method HasMany achievements()
 */
class Experience extends Model
{
    /** @use HasFactory<\Sparc\Vacancies\Database\Factories\ExperienceFactory> */
    use HasFactory;

    /** Attributes that are guarded */
    protected $guarded = [];

    /**
     * Application experience belongs to.
     * 
     * @return BelongsTo<Application, $this>
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
