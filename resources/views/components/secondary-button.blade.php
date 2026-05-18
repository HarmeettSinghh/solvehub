<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center bg-surface-container border border-outline-variant text-on-surface px-5 py-2.5 rounded text-xs font-mono font-bold hover:bg-surface-container-highest active:scale-95 transition-all duration-150 cursor-pointer uppercase tracking-wider']) }}>
    {{ $slot }}
</button>
