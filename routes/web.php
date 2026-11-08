<?php

declare(strict_types=1);

use App\Livewire\Pages\Experiments\Create as ExperimentCreate;
use App\Livewire\Pages\Sites\Index as SiteIndex;
use App\Livewire\Pages\Sites\Show as SiteShow;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Sites

    Route::livewire('/sites', SiteIndex::class)->name('sites.index');
    Route::livewire('/sites/{site}', SiteShow::class)->name('sites.show');

    // Experiments

    Route::livewire('/sites/{site}/experiments/create', ExperimentCreate::class)->name('experiments.create');
});

require __DIR__ . '/settings.php';
