<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Override;

class CreateSiteRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
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

    #[Override]
    public function validated($key = null, $default = null): mixed
    {
        $validated = array_merge(parent::validated(), [
            'domain' => Str::replace(
                search: 'https://',
                replace: '',
                subject: $this->input('domain'),
            ),
        ]);

        return data_get($validated, $key, $default);
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'domain' => Str::of($this->input('domain'))
                ->replace('http://', '')
                ->start('https://')
                ->value(),
        ]);
    }
}
