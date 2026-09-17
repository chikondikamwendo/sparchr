<?php

namespace Sparc\Vacancies\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sparc\Vacancies\Database\Factories\QualificationFactory;
use Sparc\Vacancies\Enums\QualificationLevel as Level;

/**
 * @property int $id
 * @property int $vacancy_id
 * @property string $field
 * @property string|null $description
 * @property Level $level
 * @property bool $required
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method BelongsTo<Vacancy> vacancy()
 */
class Qualification extends Model
{
    /** @use HasFactory<QualificationFactory> */
    use HasFactory;

    /** Attributes that are guarded */
    protected $guarded = [];

    /**
     * Get attributes that are casted.
     */
    public function casts(): array
    {
        return [
            'level' => Level::class,
        ];
    }

    /**
     * Vacancy qualification belongs to.
     *
     * @return BelongsTo<Vacancy, $this>
     */
    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }
}
