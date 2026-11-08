<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AssignmentController;
use App\Http\Controllers\Api\SiteController;
use Illuminate\Support\Facades\Route;

// Sites

Route::post('/sites', [SiteController::class, 'store']);

Route::middleware('ensure.site-id')
    ->group(function (): void {
        // Assignments

        Route::post('/assignments', [AssignmentController::class, 'store']);
    });
