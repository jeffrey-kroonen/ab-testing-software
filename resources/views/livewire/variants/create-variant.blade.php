<div class="space-y-8">
    <flux:field>
        <flux:label badge="Required">Name</flux:label>

        <flux:input wire:model="form.name" placeholder="Enter the name of your web page" />

        <flux:error name="form.name" />
    </flux:field>

    <flux:field>
        <flux:label badge="Required">URL</flux:label>

        <flux:input wire:model="form.url" placeholder="Enter the url of your web page" />

        <flux:error name="form.url" />
    </flux:field>

    <flux:field>
        <flux:label badge="Required">Weight</flux:label>

        <flux:select wire:model="form.weight" placeholder="Choose a weight...">
            @foreach (range(1, 10) as $value)
                <flux:select.option :value="$value * 10">{{ $value / 10 }}</flux:select.option>
            @endforeach
        </flux:select>

        <flux:description> Higher weight increases how often visitors see this page. </flux:description>

        <flux:error name="form.weight" />
    </flux:field>
</div>
