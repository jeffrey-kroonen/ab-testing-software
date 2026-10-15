<?php

declare(strict_types=1);

namespace App\Enums\Experiments;

enum Status: string
{
    case DRAFT = 'draft';
    case RUNNING = 'running';
    case PAUSED = 'paused';
    case COMPLETED = 'completed';
}
