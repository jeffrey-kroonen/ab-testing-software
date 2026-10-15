<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\DevServiceProvider;
use App\Providers\FortifyServiceProvider;

return [
    AppServiceProvider::class,
    DevServiceProvider::class,
    FortifyServiceProvider::class,
];
