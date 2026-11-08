<?php

declare(strict_types=1);

namespace App\Data\Sites;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateSiteData implements Arrayable
{
    public function __construct(
        public string $clientId,
        public string $name,
        public string $domain,
        public User $user,
    ) {
    }

    public static function fromRequest(FormRequest $request): CreateSiteData
    {
        return new self(
            clientId: (string) Str::uuid(),
            name: $request->validated('name'),
            domain: $request->validated('domain'),
            user: $request->user(),
        );
    }

    public static function fromArray(
        User $user,
        array $attributes,
    ): CreateSiteData {
        return new self(
            clientId: (string) Str::uuid(),
            name: $attributes['name'],
            domain: $attributes['domain'],
            user: $user,
        );
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public static function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:150',
            ],
            'domain' => [
                'required',
                'active_url',
                'min:2',
                'max:150',
            ],
        ];
    }

    public function toArray(): array
    {
        return [
            'client_id' => $this->clientId,
            'name' => $this->name,
            'domain' => $this->domain,
            'user' => $this->user->toArray(),
        ];
    }
}
