<div class="mx-auto max-w-3xl">
    <flux:card body="inset" variant="soft">
        <flux:card.header>
            <flux:card.heading>Create an experiment</flux:card.heading>
            <flux:card.subheading>
                Fill in the details for your experiment to continue with adding variants.
            </flux:card.subheading>
        </flux:card.header>

        @if ($step === 1)
            <form wire:submit="saveExperiment">
                <flux:card.body
                    x-data="{
                        keyIsAltered: false,
                    }"
                >
                    <div class="space-y-4">
                        <div class="grid items-start gap-4 md:grid-cols-2">
                            <flux:field>
                                <flux:label badge="Required">Name</flux:label>

                                <flux:input
                                    wire:model="experimentForm.name"
                                    type="text"
                                    required
                                    x-on:keyup="
                                        (e) =>
                                            keyIsAltered
                                                ? null
                                                : ($wire.experimentForm.key = e.target.value
                                                      .replace(/\W+/g, '-')
                                                      .toLowerCase())
                                    "
                                />

                                <flux:error name="experimentForm.name" />
                            </flux:field>

                            <flux:field>
                                <flux:label badge="Required">Key</flux:label>

                                <flux:input
                                    wire:model="experimentForm.key"
                                    type="text"
                                    required
                                    x-on:keyup="() => (keyIsAltered = true)"
                                />

                                <flux:description>
                                    This key is used for identification by your website for A/B testing.
                                </flux:description>

                                <flux:error name="experimentForm.key" />
                            </flux:field>
                        </div>

                        <flux:textarea
                            wire:model="experimentForm.description"
                            label="Description"
                            badge="Optional"
                            placeholder="Enter a description for your later self."
                        />
                    </div>
                </flux:card.body>

                <flux:card.footer>
                    <flux:text>Step {{ $step }} of 3</flux:text>
                    <flux:card.actions>
                        <flux:button variant="ghost" wire:click="previous"> Cancel </flux:button>
                        <flux:button variant="primary" type="submit" icon="arrow-long-right" iconVariant="solid">
                            {{ "Step {$nextStep}" }}
                        </flux:button>
                    </flux:card.actions>
                </flux:card.footer>
            </form>
        @endif

        @if ($step === 2)
            <form wire:submit="dispatchVariantSubmission">
                <flux:card.body>
                    <div class="space-y-8">
                        <flux:heading>What is the current page you use at your website?</flux:heading>

                        @livewire('variants.create-variant', [
                            'variantId' => $experiment->variants->first(fn (App\Models\Variant $variant) => $variant->is_control)?->id,
                        ])
                    </div>
                </flux:card.body>

                <flux:card.footer>
                    <flux:text>Step 2 of 3</flux:text>
                    <flux:card.actions>
                        <flux:button variant="ghost" wire:click="previous"> Previous </flux:button>
                        <flux:button variant="primary" type="submit" icon="arrow-long-right" iconVariant="solid">
                            {{ "Step {$nextStep}" }}
                        </flux:button>
                    </flux:card.actions>
                </flux:card.footer>
            </form>
        @endif

        @if ($step === 3)
            <form wire:submit="complete">
                <flux:card.body>
                    <div class="space-y-8">
                        <div class="flex items-center justify-between">
                            <flux:heading>Create variants for your experiment.</flux:heading>

                            <flux:modal.trigger name="add-variant">
                                <flux:button size="sm" icon="plus">Add variant</flux:button>
                            </flux:modal.trigger>
                        </div>

                        @if ($experiment->variants->where(fn (App\Models\Variant $variant) => ! $variant->is_control)->isNotEmpty())
                            <div class="space-y-4">
                                @foreach ($experiment->variants->where(fn (App\Models\Variant $variant) => ! $variant->is_control) as $variant)
                                    <div class="flex items-center justify-between rounded-xl border p-8 hover:bg-zinc-50/50 dark:hover:bg-white/10">
                                        <div class="space-y-2">
                                            <flux:heading>{{ $variant->name }}</flux:heading>
                                            <flux:text>{{ $variant->url }}</flux:text>
                                        </div>

                                        <flux:modal.trigger name="delete-variant">
                                            <flux:icon.x-mark
                                                wire:click="$set('variantIdToDelete', {{ $variant->id }})"
                                                class="cursor-pointer [:where(&)]:text-zinc-500 [:where(&)]:dark:text-white/70"
                                            />
                                        </flux:modal.trigger>
                                    </div>
                                @endforeach
                            </div>

                            <flux:modal name="delete-variant" class="min-w-[22rem]">
                                <div class="space-y-6">
                                    <div>
                                        <flux:heading size="lg">Delete variant?</flux:heading>

                                        <flux:text class="mt-2">
                                            You're about to delete this variant.<br />
                                            This action cannot be reversed.
                                        </flux:text>
                                    </div>

                                    <div class="flex gap-2">
                                        <flux:spacer />

                                        <flux:modal.close>
                                            <flux:button variant="ghost">Cancel</flux:button>
                                        </flux:modal.close>

                                        <flux:button wire:click="deleteVariant" type="button" variant="danger"
                                            >Delete variant</flux:button>
                                    </div>
                                </div>
                            </flux:modal>
                        @endif
                    </div>

                    <flux:modal name="add-variant" flyout>
                        <div>
                            <div class="space-y-6">
                                <div>
                                    <flux:heading size="lg">Add variant</flux:heading>
                                    <flux:text class="mt-2">Create a new variant.</flux:text>
                                </div>

                                @livewire('variants.create-variant')

                                <div class="flex">
                                    <flux:spacer />

                                    <flux:button type="button" wire:click="dispatchVariantSubmission" variant="primary"
                                        >Create variant</flux:button>
                                </div>
                            </div>
                        </div>
                    </flux:modal>
                </flux:card.body>

                <flux:card.footer>
                    <flux:text>Step 3 of 3</flux:text>
                    <flux:card.actions>
                        <flux:button variant="ghost" wire:click="previous"> Previous </flux:button>
                        <flux:button variant="primary" type="submit" icon="check" iconVariant="mini">
                            Complete
                        </flux:button>
                    </flux:card.actions>
                </flux:card.footer>
            </form>
        @endif
    </flux:card>
</div>
