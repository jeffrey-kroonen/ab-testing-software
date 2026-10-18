<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int|null $weight
 * @property bool $is_control
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property int $experiment_id
 * @property-read \App\Models\Experiment $experiment
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $variants
 * @property-read int|null $variants_count
 * @method static \Database\Factories\VariantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant whereExperimentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant whereIsControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Variant whereWeight($value)
 * @mixin \Eloquent
 */
class Variant extends Model
{
    /** @use HasFactory<\Database\Factories\VariantFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'weight' => 'integer',
            'is_control' => 'boolean',
        ];
    }

    // Relations

    public function experiment(): BelongsTo
    {
        return $this->belongsTo(
            related: Experiment::class,
        );
    }

    public function variants(): HasMany
    {
        return $this->hasMany(
            related: Event::class,
        );
    }
}
