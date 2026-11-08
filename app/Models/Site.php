<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\SiteFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $domain
 * @property CarbonImmutable|null $created_at
 * @property CarbonImmutable|null $updated_at
 * @property int $user_id
 * @property-read Collection<int, Experiment> $experiments
 * @property-read int|null $experiments_count
 * @property-read User $user
 * @method static \Database\Factories\SiteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site whereUserId($value)
 * @mixin \Eloquent
 */
class Site extends Model
{
    /** @use HasFactory<SiteFactory> */
    use HasFactory;

    // Relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
        );
    }

    public function experiments(): HasMany
    {
        return $this->hasMany(
            related: Experiment::class,
        );
    }
}
