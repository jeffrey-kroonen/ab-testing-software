<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SiteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
