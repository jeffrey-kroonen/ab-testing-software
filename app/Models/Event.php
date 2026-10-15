<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Events\EventType;
use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'event_type' => EventType::class,
        ];
    }

    // Relations

    public function variant(): BelongsTo
    {
        return $this->belongsTo(
            related: Variant::class,
        );
    }
}
