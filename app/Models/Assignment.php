<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\AssignmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $visitor_id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property int $variant_id
 * @property int $experiment_id
 * @property-read \App\Models\Experiment $experiment
 * @property-read \App\Models\Variant $variant
 * @method static \Database\Factories\AssignmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assignment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assignment whereExperimentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assignment whereVariantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Assignment whereVisitorId($value)
 * @mixin \Eloquent
 */
class Assignment extends Model
{
    /** @use HasFactory<AssignmentFactory> */
    use HasFactory;

    // Relations

    public function variant(): BelongsTo
    {
        return $this->belongsTo(
            related: Variant::class,
        );
    }

    // Relations

    public function experiment(): BelongsTo
    {
        return $this->belongsTo(
            related: Experiment::class,
        );
    }
}
