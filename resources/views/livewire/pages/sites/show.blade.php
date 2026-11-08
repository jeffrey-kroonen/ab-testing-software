<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:card>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <flux:heading>{{ $site->name }}</flux:heading>
                    <flux:text class="mt-1 text-neutral-400">{{ $site->domain }}</flux:text>
                </div>

                <flux:button size="sm" icon="pencil">Edit</flux:button>
            </div>
        </flux:card>

        <flux:card body="inset" variant="soft">
            <flux:card.header>
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <flux:heading>Experiments</flux:heading>
                        <flux:text class="mt-1">Manage your experiments for this site.</flux:text>
                    </div>

                    @if ($this->experiments->isNotEmpty())
                        <a href="{{ route('experiments.create', ['site' => $site->id]) }}">
                            <flux:button size="sm" icon="plus">Add experiment</flux:button>
                        </a>
                    @endif
                </div>
            </flux:card.header>

            <flux:card.body class="space-y-4">
                @if ($this->experiments->isEmpty())
                    <div class="space-y-4 p-8 text-center tracking-wide">
                        <p class="text-sm text-neutral-500">No experiments yet. Create your first one.</p>

                        <a href="{{ route('experiments.create', ['site' => $site->id]) }}">
                            <flux:button size="sm" icon="plus">Add experiment</flux:button>
                        </a>
                    </div>
                @else
                    <flux:table bleed>
                        <flux:table.columns>
                            <flux:table.column>Name</flux:table.column>
                            <flux:table.column>Status</flux:table.column>
                            <flux:table.column>started At</flux:table.column>
                            <flux:table.column>Ended At</flux:table.column>
                            <flux:table.column>Created At</flux:table.column>
                        </flux:table.columns>

                        <flux:table.rows>
                            @foreach ($this->experiments as $experiment)
                                <flux:table.row
                                    :key="$experiment->id"
                                    class="cursor-pointer hover:bg-red-950/25"
                                    {{-- x-on:click="window.location.href = '{{ route('sites.show', ['site' => $site->id]) }}'" --}}
                                >
                                    <flux:table.cell variant="strong">{{ $experiment->name }}</flux:table.cell>
                                    <flux:table.cell>{{ $experiment->status }}</flux:table.cell>
                                    <flux:table.cell>
                                        {{ $experiment->started_at?->format('d-m-Y') ?? '-' }}</flux:table.cell>
                                    <flux:table.cell>
                                        {{ $experiment->ended_at?->format('d-m-Y') ?? '-' }}</flux:table.cell>
                                    <flux:table.cell>{{ $experiment->created_at->format('d-m-Y') }}</flux:table.cell>
                                </flux:table.row>
                            @endforeach
                        </flux:table.rows>
                    </flux:table>
                @endif
            </flux:card.body>
        </flux:card>
    </div>
</div>
