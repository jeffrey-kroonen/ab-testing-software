<div
    x-data="{
        keyIsAltered: false,
    }"
    class="space-y-8"
>
    <div class="my-2 grid items-start gap-4 md:grid-cols-2">
        <flux:field>
            <flux:label badge="Required">Name</flux:label>

            <flux:input
                wire:model="form.name"
                type="text"
                required
                x-on:keyup="
                    (e) => (keyIsAltered ? null : ($wire.form.key = e.target.value.replace(/\W+/g, '-').toLowerCase()))
                "
            />

            <flux:error name="form.name" />
        </flux:field>

        <flux:field>
            <flux:label badge="Required">Key</flux:label>

            <flux:input wire:model="form.key" type="text" required x-on:keyup="() => (keyIsAltered = true)" />

            <flux:description> This key is used for identification by your website for A/B testing. </flux:description>

            <flux:error name="form.key" />
        </flux:field>
    </div>

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
