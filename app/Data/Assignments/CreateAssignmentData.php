<?php

declare(strict_types=1);

namespace App\Data\Assignments;

use App\Models\Experiment;
use App\Models\Variant;
use Illuminate\Contracts\Support\Arrayable;

class CreateAssignmentData implements Arrayable
{
    public function __construct(
        public string $visitorId,
        public Variant $variant,
        public Experiment $experiment,
    ) {
        //
    }

    public function toArray(): array
    {
        return [
            'visitor_id' => $this->visitorId,
            'variant' => $this->variant->toArray(),
            'experiment' => $this->experiment->toArray(),
        ];
    }
}
