<?php

declare(strict_types=1);

namespace App\Data\Sites;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class CreateSiteData implements Arrayable
{
    public function __construct(
        public string $name,
        public string $domain,
        public User $user,
    ) {
    }

    public static function fromRequest(FormRequest $request): static
    {
        return new self(
            name: $request->validated('name'),
            domain: $request->validated('domain'),
            user: $request->user(),
        );
    }

    #[Override]
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'domain' => $this->domain,
            'user' => $this->user->toArray(),
        ];
    }
}
