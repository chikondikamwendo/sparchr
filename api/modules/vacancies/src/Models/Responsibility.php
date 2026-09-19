<?php

namespace Sparc\Vacancies\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Sparc\Vacancies\Database\Factories\ResponsibilityFactory;

/**
 * @property int $id
 * @property int $responsibilitable_id
 * @property string $responsibilitable_type
 * @property string $title
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method MorphTo responsibilitable()
 */
class Responsibility extends Model
{
    /** @use HasFactory<ResponsibilityFactory> */
    use HasFactory;

    /** Attributes that are guarded */
    protected $guarded = [];

    /** @return MorphTo */
    public function responsibilitable(): MorphTo
    {
        return $this->morphTo();
    }
}
