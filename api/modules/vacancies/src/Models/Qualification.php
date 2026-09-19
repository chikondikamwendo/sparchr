<?php

namespace Sparc\Vacancies\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Sparc\Vacancies\Database\Factories\QualificationFactory;
use Sparc\Vacancies\Enums\QualificationLevel as Level;

/**
 * @property int $id
 * @property int $qualificationable_id
 * @property string $qualificationable_type
 * @property string $field
 * @property Level $level
 * @property string|null $institution
 * @property string|null $description
 * @property bool|null $required
 * @property int|null $year
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method MorphTo qualificationable()
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

    public function qualificationable(): MorphTo
    {
        return $this->morphTo();
    }
}
