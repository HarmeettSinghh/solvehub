@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-mono text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold']) }}>
    {{ $value ?? $slot }}
</label>
