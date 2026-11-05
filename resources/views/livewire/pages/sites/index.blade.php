<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:card>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <flux:heading>My sites</flux:heading>
                    <flux:text class="mt-1">Manage your sites to setup A/B-testing.</flux:text>
                </div>

                <flux:modal.trigger name="add-site">
                    <flux:button size="sm" icon="plus">Add site</flux:button>
                </flux:modal.trigger>
            </div>

            <flux:table bleed container:class="mt-6">
                <flux:table.columns>
                    <flux:table.column>Site</flux:table.column>
                    <flux:table.column>Domain</flux:table.column>
                    <flux:table.column>Created At</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($sites as $site)
                    <flux:table.row :key="$site->id">
                        <flux:table.cell variant="strong">{{ $site->name }}</flux:table.cell>
                        <flux:table.cell>{{ $site->domain }}</flux:table.cell>
                        <flux:table.cell>{{ $site->created_at->format('d-m-Y') }}</flux:table.cell>
                    </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
        </flux:card>
    </div>

    <flux:modal name="add-site" class="md:w-96">
        <div>
            <form wire:submit="createSite" class="space-y-6">
                <div>
                    <flux:heading size="lg">Add site</flux:heading>
                    <flux:text class="mt-2">Create a new site to setup A/B-testing.</flux:text>
                </div>

                <flux:input wire:model="form.name" label="Name" placeholder="Enter the name of your site" />

                <flux:input wire:model="form.domain" label="Domain" placeholder="Enter the domain of your site" />

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Create site</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>