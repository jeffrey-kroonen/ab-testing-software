<?php

declare(strict_types=1);

use App\Http\Controllers\Api\SiteController;
use Illuminate\Support\Facades\Route;

Route::post('/sites', [SiteController::class, 'store']);
