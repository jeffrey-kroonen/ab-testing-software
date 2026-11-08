<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Experiments\Status;
use Carbon\CarbonImmutable;
use Database\Factories\ExperimentFactory;
use Illuminate\Database\Eloquent\Collection;
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
 * @property CarbonImmutable|null $started_at
 * @property CarbonImmutable|null $ended_at
 * @property CarbonImmutable|null $created_at
 * @property CarbonImmutable|null $updated_at
 * @property int $site_id
 * @property-read Site $site
 * @property-read Collection<int, Variant> $variants
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

    /**
     * @return BelongsTo<Site, $this>
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(
            related: Site::class,
        );
    }

    /**
     * @return HasMany<Variant, $this>
     */
    public function variants(): HasMany
    {
        return $this->hasMany(
            related: Variant::class,
        );
    }
}
