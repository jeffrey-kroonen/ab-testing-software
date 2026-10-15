<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Experiments\Status;
use Database\Factories\ExperimentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
