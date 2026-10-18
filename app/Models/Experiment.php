<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Experiments\Status;
use Database\Factories\ExperimentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $key
 * @property Status $status
 * @property \Carbon\CarbonImmutable|null $started_at
 * @property \Carbon\CarbonImmutable|null $ended_at
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property int $site_id
 * @property-read \App\Models\Site $site
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Variant> $variants
 * @property-read int|null $variants_count
 * @method static \Database\Factories\ExperimentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereEndedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Experiment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Experiment extends Model
{
    /** @use HasFactory<ExperimentFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    // Relations

    public function site(): BelongsTo
    {
        return $this->belongsTo(
            related: Site::class,
        );
    }

    public function variants(): HasMany
    {
        return $this->hasMany(
            related: Variant::class,
        );
    }
}
