<?php

declare(strict_types=1);

use App\Models\Variant;
use App\Services\VariantService;
use Database\Factories\ExperimentFactory;
use Database\Factories\SiteFactory;
use Database\Factories\UserFactory;
use Database\Factories\VariantFactory;

it('can retrieve random bucked by taking weight into account', function (): void {
    $user = UserFactory::new()->create();
    $site = SiteFactory::new()
        ->for($user)
        ->create();
    $experiment = ExperimentFactory::new()
        ->for($site)
        ->create();

    VariantFactory::new(['weight' => 0])
        ->for($experiment)
        ->create();
    $expected = VariantFactory::new(['weight' => 100])
        ->for($experiment)
        ->create();

    $service = app(VariantService::class);
    $variant = $service->determineVariantForVisitor($experiment);

    expect($variant)->toBeInstanceOf(Variant::class);
    expect($variant->id)->toBe($expected->id);
})
->only();
