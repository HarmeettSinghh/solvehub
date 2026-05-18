<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center bg-primary text-on-primary px-5 py-2.5 rounded text-xs font-mono font-bold hover:opacity-90 active:scale-95 transition-all duration-150 cursor-pointer uppercase tracking-wider']) }}>
    {{ $slot }}
</button>
