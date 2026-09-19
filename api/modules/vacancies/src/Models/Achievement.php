<?php

namespace Sparc\Vacancies\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $experience_id
 * @property string $title
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @method BelongsTo<Experience> experience()
 */
class Achievement extends Model
{
    /** @use HasFactory<\Sparc\Vacancies\Database\Factories\AchievementFactory> */
    use HasFactory;

    /** Attributes that are guarded */
    protected $guarded = [];

    /**
     * Experience achievement belongs to.
     * 
     * @return BelongsTo<Experience, $this>
     */
    public function experience(): BelongsTo
    {
        return $this->belongsTo(Experience::class);
    }
}
