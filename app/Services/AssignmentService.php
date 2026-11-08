<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Assignments\CreateAssignmentData;
use App\Models\Assignment;
use Illuminate\Support\Arr;

class AssignmentService
{
    public function findOrCreateAssignment(
        string $clientVisitorId,
        string $experimentKey,
    ): Assignment {
        $visitorId = $this->generateVisitorId(
            $clientVisitorId,
            $experimentKey,
        );

        $assignment = $this->findAssignmentByVisitorId($visitorId);

        if ($assignment !== null) {
            return $assignment;
        }

        $experiment = app(ExperimentService::class)->findExperimentByKey($experimentKey);

        return $this->create(new CreateAssignmentData(
            visitorId: $visitorId,
            variant:  app(VariantService::class)->determineVariantForVisitor($experiment),
            experiment: $experiment,
        ));
    }

    public function create(CreateAssignmentData $data): Assignment
    {
        $attributes = Arr::only($data->toArray(), [
            'visitor_id',
        ]);

        $assignment = new Assignment($attributes);
        $assignment->variant()->associate($data->variant);
        $assignment->experiment()->associate($data->variant);
        $assignment->save();

        return $assignment;
    }

    private function generateVisitorId(
        string $clientVisitorId,
        string $experimentKey,
    ): string {
        return md5(
            $clientVisitorId . $experimentKey,
        );
    }

    private function findAssignmentByVisitorId(string $visitorId): ?Assignment
    {
        return Assignment::query()
            ->firstWhere('visitor_id', $visitorId);
    }
}
