<?php

declare(strict_types=1);

use App\Livewire\Pages\Sites\Index;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::livewire('/sites', Index::class)->name('sites.index');
});

require __DIR__ . '/settings.php';
