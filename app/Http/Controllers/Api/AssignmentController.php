<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Enums\Experiments\Status;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Services\AssignmentService;
use App\Services\ExperimentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        //
    }

    public function store(
        Request $request,
        ExperimentService $experimentService,
        AssignmentService $assignmentService,
    ): JsonResponse {
        $clientVisitorId = $request->input('visitor_id');
        $experimentKey = $request->input('experiment_key');

        $experiment = $experimentService->findExperimentByKey($request->input('experiment_key'));

        if ($experiment === null) {
            return new JsonResponse(status: 404);
        }

        if ($experiment->status !== Status::RUNNING) {
            return new JsonResponse(
                data: ['message' => 'The [status] of the experiment is not "running".'],
                status: 422,
            );
        }

        $assignment = $assignmentService->findOrCreateAssignment(
            clientVisitorId: $clientVisitorId,
            experimentKey: $experimentKey,
        );

        return new JsonResponse([
            'assignment' => $assignment->variant->key,
        ]);
    }

    public function show(Assignment $assignment): void
    {
        //
    }

    public function update(Request $request, Assignment $assignment): void
    {
        //
    }

    public function destroy(Assignment $assignment): void
    {
        //
    }
}
