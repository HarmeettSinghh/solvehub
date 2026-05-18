@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-outline-variant/50']) }}>
