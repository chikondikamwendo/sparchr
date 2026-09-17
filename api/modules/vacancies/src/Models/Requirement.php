<?php

namespace Sparc\Vacancies\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sparc\Vacancies\Database\Factories\RequirementFactory;

/**
 * @property int $id
 * @property int $vacancy_id
 * @property string $title
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method BelongsTo<Vacancy> vacancy()
 */
class Requirement extends Model
{
    /** @use HasFactory<RequirementFactory> */
    use HasFactory;

    /** Attributes that are guarded */
    protected $guarded = [];

    /**
     * Vacancy requirement belongs to.
     *
     * @return BelongsTo<Vacancy, $this>
     */
    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }
}
